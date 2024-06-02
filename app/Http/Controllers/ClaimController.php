<?php

namespace App\Http\Controllers;

use App\Exports\ClaimsExport;
use App\Http\Requests\CreateClaimRequest;
use App\Models\Claim;
use App\Models\Hospital;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use IntlDateFormatter;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class ClaimController extends Controller
{
    public function showCreatePage()
    {
        $hospitals = Hospital::all();
        $route = Session::get('routeFrom');
        if ($route == 'fktp') {
            $hospitals = $hospitals->where('level', 'FKTP');
        } else {
            $hospitals = $hospitals->where('level', 'FKRTL');
        }

        return view('pages.claim.create-claim', [
            'hospitals' => $hospitals,
        ]);
    }

    public function createProcess(CreateClaimRequest $request)
    {
        $data = $request->validated();
        $text = $data['nama_rs'];
        $parts = explode('-', $text);
        $rs_name = trim($parts[1]);
        $hospital = Hospital::where('name', $rs_name)->first();

        $exists = Claim::where('hospital_name', $hospital->name)
            ->where('claim_type', $data['jenis_claim'])
            ->where('month', $data['bulan'] . ' ' . $data['tahun'])
            ->exists();

        try {
            DB::transaction(function () use ($data, $hospital, $exists) {
                $date = new DateTime($data['tanggal_ba']);
                $hospitalUuid = $hospital->uuid;
                $level = $hospital->level;
                $userUid = auth()->user()->uuid;

                if ($exists != true) {
                    if ($level == 'FKRTL') {
                        Claim::create([
                            'user_uuid' => $userUid,
                            'hospital_uuid' => $hospitalUuid,
                            'hospital_name' => $hospital->name,
                            'level' => $level,
                            'claim_type' => $data['jenis_claim'],
                            'month' => $data['bulan'] . ' ' . $data['tahun'],
                            'created_date' => $data['tanggal_ba'],
                            'ba_date' => $data['tanggal_ba'],
                            'completion_limit_date' => $date->modify('+9 day'),
                            'status' => 'BA Serah Terima',
                        ]);
                    } else {
                        Claim::create([
                            'user_uuid' => $userUid,
                            'hospital_uuid' => $hospitalUuid,
                            'hospital_name' => $hospital->name,
                            'level' => $level,
                            'claim_type' => $data['jenis_claim'],
                            'month' => $data['bulan'] . ' ' . $data['tahun'],
                            'created_date' => $data['tanggal_ba'],
                            'ba_date' => $data['tanggal_ba'],
                            'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_ba']), 1),
                            'status' => 'BA Serah Terima',
                        ]);
                    }
                }
            });

            if ($exists) {
                return redirect()->back()->with('error', 'Klaim telah terdaftar');
            }
            if ($hospital->level == 'FKRTL') {
                return redirect()->route('claim.fkrtl')->with('success', 'Berhasil membuat klaim baru');
            } else {
                return redirect()->route('claim.fktp')->with('success', 'Berhasil membuat klaim baru');
            }
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal membuat klaim baru: ' . $e->getMessage());
        }
    }

    public function addBusinessDays($date, $daysToAdd)
    {
        $holidays = config('app.holidays');

        for ($i = 0; $i < $daysToAdd; $i++) {
            $date->addDay();

            // Skip weekends
            while ($date->isWeekend()) {
                $date->addDay();
            }

            // Skip holidays
            while (in_array($date->format('Y-m-d'), $holidays)) {
                $date->addDay();

                // Make sure to skip weekends after adding a day for holiday
                while ($date->isWeekend()) {
                    $date->addDay();
                }
            }
        }

        return $date;
    }

    public function showEditPage(string $id)
    {
        $claim = Claim::find($id);

        return view('pages.claim.edit-claim', [
            'claim' => $claim,
        ]);
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $claim = Claim::find($data['id']);

        try {
            DB::transaction(function () use ($data, $claim) {
                if (auth()->user()->role == 'STAFF_ADMIN') {
                    $claim->update([
                        'ritl_number' => $data['no_reg_boa_ri'],
                        'rjtl_number' => $data['no_reg_boa_rj'],
                    ]);
                    if ($claim->level == 'FKRTL') {
                        return redirect()->route('claim.fkrtl')->with('success', 'Berhasil mengubah klaim');
                    } else {
                        return redirect()->route('claim.fktp')->with('success', 'Berhasil mengubah klaim');
                    }
                }
                if ($claim->level == 'FKRTL') {
                    if ($data['status'] == Claim::STATUS_BA_SERAH_TERIMA) {
                        $date = new DateTime($data['tanggal_pembuatan_ba']);
                        $claim->update([
                            'created_date' => $data['tanggal_pembuatan_ba'],
                            'ba_date' => $data['tanggal_pembuatan_ba'],
                            'file_completeness' => null,
                            'completion_limit_date' => $date->modify('+9 day'),
                            'status' => $data['status'],
                            'ritl_number' => null,
                            'rjtl_number' => null,
                        ]);
                    } else {
                        $date = new DateTime($data['tanggal_kelengkapan_ba']);
                        if ($data['status'] == Claim::STATUS_TELAH_SETUJU) {
                            $claim->update([
                                'created_date' => $data['tanggal_pembuatan_ba'],
                                'ba_date' => now(),
                                'file_completeness' => $data['tanggal_kelengkapan_ba'],
                                'completion_limit_date' => $date->modify('+14 day'),
                                'status' => $data['status'],
                                'ritl_number' => $data['no_reg_boa_ri'],
                                'rjtl_number' => $data['no_reg_boa_rj'],
                            ]);
                        } else {
                            $claim->update([
                                'created_date' => $data['tanggal_pembuatan_ba'],
                                'ba_date' => now(),
                                'file_completeness' => $data['tanggal_kelengkapan_ba'],
                                'completion_limit_date' => $date->modify('+9 day'),
                                'status' => $data['status'],
                                'ritl_number' => $data['no_reg_boa_ri'],
                                'rjtl_number' => $data['no_reg_boa_rj'],
                            ]);
                        }
                    }
                } else {
                    if ($data['status'] == Claim::STATUS_BA_SERAH_TERIMA) {
                        $date = new DateTime($data['tanggal_pembuatan_ba']);
                        $claim->update([
                            'created_date' => $data['tanggal_pembuatan_ba'],
                            'ba_date' => $data['tanggal_pembuatan_ba'],
                            'file_completeness' => null,
                            'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_pembuatan_ba']), 1),
                            'status' => $data['status'],
                            'ritl_number' => null,
                            'rjtl_number' => null,
                        ]);
                    } else {
                        $date = new DateTime($data['tanggal_kelengkapan_ba']);
                        if ($data['status'] == Claim::STATUS_TELAH_SETUJU) {
                            $claim->update([
                                'created_date' => $data['tanggal_pembuatan_ba'],
                                'ba_date' => now(),
                                'file_completeness' => $data['tanggal_kelengkapan_ba'],
                                'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_kelengkapan_ba']), 14),
                                'status' => $data['status'],
                                'ritl_number' => $data['no_reg_boa_ri'],
                                'rjtl_number' => $data['no_reg_boa_rj'],
                            ]);
                        } else {
                            $claim->update([
                                'created_date' => $data['tanggal_pembuatan_ba'],
                                'ba_date' => now(),
                                'file_completeness' => $data['tanggal_kelengkapan_ba'],
                                'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_kelengkapan_ba']), 9),
                                'status' => $data['status'],
                                'ritl_number' => $data['no_reg_boa_ri'],
                                'rjtl_number' => $data['no_reg_boa_rj'],
                            ]);
                        }
                    }
                }
            });

            if ($claim->level == 'FKRTL') {
                return redirect()->route('claim.fkrtl')->with('success', 'Berhasil mengubah klaim');
            } else {
                return redirect()->route('claim.fktp')->with('success', 'Berhasil mengubah klaim');
            }
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah klaim: ' . $e->getMessage());
        }
    }

    public function delete(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $claim->delete();
            });

            return redirect()->back()->with('success', 'Berhasil menghapus klaim');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus klaim: ' . $e->getMessage());
        }
    }

    public function approveFinance(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Claim::whereIn('uuid', $request->ids)->update([
                    'ba_date' => now(),
                    'status' => Claim::STATUS_TELAH_BAYAR,
                ]);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveFinanceSingle(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $claim->update([
                    'ba_date' => now(),
                    'status' => Claim::STATUS_TELAH_BAYAR,
                ]);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveStaff(string $id, Request $request)
    {
        try {
            DB::transaction(function () use ($id, $request) {
                $claim = Claim::find($id);

                $claim->update([
                    'ba_date' => now(),
                    'ritl_number' => $request->no_reg_boa_ri,
                    'rjtl_number' => $request->no_reg_boa_rj,
                    'register_boa_date' => now(),
                    'status' => Claim::STATUS_TELAH_REGISTER_BOA,
                ]);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveHead(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $claim = Claim::find($request->ids[0]);
                $date = new DateTime($claim->file_completeness);

                if ($claim->level == 'FKRTL') {
                    Claim::whereIn('uuid', $request->ids)->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'approve_head_date' => now(),
                        'completion_limit_date' => $date->modify('+14 days'),
                    ]);
                } else {
                    Claim::whereIn('uuid', $request->ids)->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'approve_head_date' => now(),
                        'completion_limit_date' => $this->addBusinessDays(Carbon::parse($claim->file_completeness), 14),
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveHeadSingle(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $date = new DateTime($claim->file_completeness);

                if ($claim->level == 'FKRTL') {
                    $claim->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'approve_head_date' => now(),
                        'completion_limit_date' => $date->modify('+14 days'),
                    ]);
                } else {
                    $claim->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'approve_head_date' => now(),
                        'completion_limit_date' => $this->addBusinessDays(Carbon::parse($claim->file_completeness), 14),
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveVerificator(string $id, Request $request)
    {
        $data = $request->all();

        try {
            DB::transaction(function () use ($id, $data) {
                $claim = Claim::find($id);

                if (!$claim) {
                    throw new \Exception('Klaim tidak ditemukan');
                }

                if ($claim->level == 'FKRTL') {
                    if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                        $updateData['ba_date'] = $data['tanggal_ba_lengkap'];
                        $updateData['status'] = Claim::STATUS_BA_KELENGKAPAN_BERKAS;
                        $updateData['file_completeness'] = $data['tanggal_ba_lengkap'];
                        $updateData['completion_limit_date'] = now()->modify('+9 day');
                    } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS) {
                        $updateData = ['ba_date' => now()];
                        $updateData['fpk_number_ri'] = $data['no_reg_fpk_ri'];
                        $updateData['fpk_number_rj'] = $data['no_reg_fpk_rj'];
                        $updateData['bahv_date'] = now();
                        $updateData['status'] = Claim::STATUS_BA_HASIL_VERIFIKASI;
                    }
                } else {
                    if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                        $updateData['ba_date'] = $data['tanggal_ba_lengkap'];
                        $updateData['status'] = Claim::STATUS_BA_KELENGKAPAN_BERKAS;
                        $updateData['file_completeness'] = $data['tanggal_ba_lengkap'];
                        $updateData['completion_limit_date'] = $this->addBusinessDays(now(), 9);
                    } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS) {
                        $updateData = ['ba_date' => now()];
                        $updateData['fpk_number_ri'] = $data['no_reg_fpk_ri'];
                        $updateData['fpk_number_rj'] = $data['no_reg_fpk_rj'];
                        $updateData['bahv_date'] = now();
                        $updateData['status'] = Claim::STATUS_BA_HASIL_VERIFIKASI;
                    }
                }
                $claim->update($updateData);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function showHistoryPage()
    {
        $claims = Claim::where('status', Claim::STATUS_TELAH_BAYAR)->get();

        return view('pages.history.history', [
            'claims' => $claims,
        ]);
    }

    public function export_fkrtl()
    {
        $claims = $this->getClaims('FKRTL');

        return Excel::download(new ClaimsExport($claims), 'movie-sla-fkrtl.xlsx');
    }

    public function export_fktp()
    {
        $claims = $this->getClaims('FKTP');

        return Excel::download(new ClaimsExport($claims), 'movie-sla-fktp.xlsx');
    }

    public function export_history()
    {
        $claims = Claim::where('status', Claim::STATUS_TELAH_BAYAR)->get();

        return Excel::download(new ClaimsExport($claims), 'movie-riwayat-klaim.xlsx');
    }

    private function getClaims($level)
    {
        return Claim::with('hospital')->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')->where('status', '!=', 'Pembayaran Telah Dilakukan')->where('hospitals.level', $level)->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')->orderBy('claims.updated_at', 'desc')->get();
    }

    public function downloadWord(string $id)
    {
        $claim = Claim::find($id);
        $fileName = '';
        $recepientName = auth()->user()->name;

        [$monthService, $yearService] = explode(' ', $claim->month);

        if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA && (strpos(strtolower($claim->claim_type), 'ambulance') !== false || strpos(strtolower($claim->claim_type), 'alkes') !== false)) {
            $dateNow = Carbon::parse($claim->created_date)
                ->locale('id')
                ->translatedFormat('l d F Y');
            [$day, $todayDate, $todayMonth, $todayYear] = explode(' ', $dateNow);

            $templateProcessor = new TemplateProcessor('bast.docx');
            $templateProcessor->setValues([
                'day' => $day,
                'todayDate' => $todayDate,
                'todayMonth' => $todayMonth,
                'todayYear' => $todayYear,
                'faskesName' => $claim->hospital_name,
                'monthService' => $monthService,
                'yearService' => $yearService,
                'recepientName' => $recepientName,
            ]);

            $fileName = 'BAST_Movie_' . time() . '.docx';
            $templateProcessor->saveAs($fileName);

            return response()->download($fileName)->deleteFileAfterSend(true);
        } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS && (strpos(strtolower($claim->claim_type), 'ambulance') !== false || strpos(strtolower($claim->claim_type), 'alkes') !== false)) {
            $dateNow = Carbon::parse($claim->file_completeness)->locale('id')->translatedFormat('l d F Y');
            [$day, $todayDate, $todayMonth, $todayYear] = explode(' ', $dateNow);

            $templateProcessor = new TemplateProcessor('ba-lengkap.docx');
            $templateProcessor->setValues([
                'day' => $day,
                'todayDate' => $todayDate,
                'todayMonth' => $todayMonth,
                'todayYear' => $todayYear,
                'faskesName' => $claim->hospital_name,
                'claimType' => $claim->claim_type,
                'monthService' => $monthService,
                'yearService' => $yearService,
                'recepientName' => $recepientName,
            ]);

            $fileName = 'BA Lengkap_Movie_' . time() . '.docx';
            $templateProcessor->saveAs($fileName);

            return response()->download($fileName)->deleteFileAfterSend(true);
        } elseif ($claim->status == Claim::STATUS_BA_HASIL_VERIFIKASI && (strpos(strtolower($claim->claim_type), 'ambulance') !== false || strpos(strtolower($claim->claim_type), 'alkes') !== false)) {
            $dateNow = Carbon::parse($claim->ba_date)->locale('id')->translatedFormat('l d F Y');
            [$day, $todayDate, $todayMonth, $todayYear] = explode(' ', $dateNow);

            $templateProcessor = new TemplateProcessor('bahv.docx');
            $templateProcessor->setValues([
                'day' => $day,
                'todayDate' => $todayDate,
                'todayMonth' => $todayMonth,
                'todayYear' => $todayYear,
                'faskesName' => $claim->hospital_name,
                'monthService' => $monthService,
                'yearService' => $yearService,
                'dateNow' => $todayDate . ' ' . $todayMonth . ' ' . $todayYear,
            ]);

            $fileName = 'BAHV_Movie_' . time() . '.docx';
            $templateProcessor->saveAs($fileName);

            return response()->download($fileName)->deleteFileAfterSend(true);
        } elseif ($claim->status == Claim::STATUS_TELAH_SETUJU) {
            $locale = 'id_ID';
            $dateFormatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);

            $templateProcessor = new TemplateProcessor('lembar-APA.docx');
            $templateProcessor->setValues([
                'namaFaskes' => $claim->hospital_name,
                'nomorRJ' => $claim->rjtl_number,
                'nomorRI' => $claim->ritl_number,
                'nomorRJFPK' => $claim->fpk_number_rj,
                'nomorRIFPK' => $claim->fpk_number_ri,
                'bulanPelayanan' => $claim->month,
                'jenisKlaim' => $claim->claim_type,
                'tanggalRegisterBOA' => $dateFormatter->format(new DateTime($claim->register_boa_date == null ? now() : $claim->register_boa_date)),
                'tanggalSetujuKlaim' => $dateFormatter->format(new DateTime($claim->approve_head_date == null ? now() : $claim->approve_head_date)),
                'tanggalJatuhTempo' => $dateFormatter->format(new DateTime($claim->completion_limit_date == null ? now() : $claim->completion_limit_date)),
            ]);

            $fileName = 'Lembar APA Movie_' . time() . '.docx';
            $templateProcessor->saveAs($fileName);

            return response()->download($fileName)->deleteFileAfterSend(true);
        }

        if ($claim->status == Claim::STATUS_TELAH_BAYAR && (strpos(strtolower($claim->claim_type), 'ambulance') !== false || strpos(strtolower($claim->claim_type), 'alkes') !== false)) {
            $locale = 'id_ID';
            $dateFormatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);

            $templateProcessor = new TemplateProcessor('lembar-APA.docx');
            $templateProcessor->setValues([
                'namaFaskes' => $claim->hospital_name,
                'nomorRJ' => $claim->rjtl_number,
                'nomorRI' => $claim->ritl_number,
                'nomorRJFPK' => $claim->fpk_number_rj,
                'nomorRIFPK' => $claim->fpk_number_ri,
                'bulanPelayanan' => $claim->month,
                'jenisKlaim' => $claim->claim_type,
                'tanggalRegisterBOA' => $dateFormatter->format(new DateTime($claim->register_boa_date == null ? now() : $claim->register_boa_date)),
                'tanggalSetujuKlaim' => $dateFormatter->format(new DateTime($claim->approve_head_date == null ? now() : $claim->approve_head_date)),
                'tanggalJatuhTempo' => $dateFormatter->format(new DateTime($claim->completion_limit_date == null ? now() : $claim->completion_limit_date)),
            ]);

            $fileName = 'Lembar APA Movie_' . time() . '.docx';
            $templateProcessor->saveAs($fileName);

            return response()->download($fileName)->deleteFileAfterSend(true);
        }

        return abort(404);
    }
}

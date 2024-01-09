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
use Maatwebsite\Excel\Facades\Excel;

class ClaimController extends Controller
{
    public function showCreatePage()
    {
        $hospitals = Hospital::all();
        return view('pages.claim.create-claim', [
            'hospitals' => $hospitals
        ]);
    }

    public function createProcess(CreateClaimRequest $request)
    {
        $data = $request->validated();
        $text = $data['nama_rs'];
        $parts = explode("-", $text);
        $rs_name = trim($parts[1]);
        $hospital = Hospital::where('name', $rs_name)->first();

        try {
            DB::transaction(function () use ($data, $hospital) {
                $date = new DateTime($data['tanggal_ba']);
                $hospitalUuid = $hospital->uuid;
                $level = $hospital->level;
                $userUid = auth()->user()->uuid;

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
                        'status' => 'BA Serah Terima'
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
                        'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_ba']), 9),
                        'status' => 'BA Serah Terima'
                    ]);
                }
            });

            if ($hospital->level == 'FKRTL') {
                return redirect()->route('home')->with('success', 'Berhasil membuat klaim baru');
            } else {
                return redirect()->route('claim.fktp')->with('success', 'Berhasil membuat klaim baru');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal membuat klaim baru: ' . $e->getMessage());
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

    public function showEditPage(String $id)
    {
        $claim = Claim::find($id);
        $hospitals = Hospital::all();

        return view('pages.claim.edit-claim', [
            'claim' => $claim,
            'hospitals' => $hospitals
        ]);
    }

    public function edit(CreateClaimRequest $request)
    {
        $data = $request->all();
        $text = $data['nama_rs'];
        $parts = explode("-", $text);
        $rs_name = trim($parts[1]);
        $hospital = Hospital::where('name', $rs_name)->first();

        try {
            DB::transaction(function () use ($data, $hospital) {
                $date = new DateTime($data['tanggal_ba']);
                $hospitalUuid = $hospital->uuid;
                $level = $hospital->level;

                $claim = Claim::find($data['id']);
                if ($claim->level == 'FKRTL') {
                    $claim->update([
                        'hospital_name' => $hospital->name,
                        'hospital_uuid' => $hospitalUuid,
                        'level' => $level,
                        'claim_type' => $data['jenis_claim'],
                        'month' => $data['bulan'] . ' ' . $data['tahun'],
                        'created_date' => $data['tanggal_ba'],
                        'ba_date' => $data['tanggal_ba'],
                        'completion_limit_date' => $date->modify('+9 day'),
                        'status' => 'BA Serah Terima'
                    ]);
                } else {
                    $claim->update([
                        'hospital_name' => $hospital->name,
                        'hospital_uuid' => $hospitalUuid,
                        'level' => $level,
                        'claim_type' => $data['jenis_claim'],
                        'month' => $data['bulan'] . ' ' . $data['tahun'],
                        'created_date' => $data['tanggal_ba'],
                        'ba_date' => $data['tanggal_ba'],
                        'completion_limit_date' => $this->addBusinessDays(Carbon::parse($data['tanggal_ba']), 9),
                        'status' => 'BA Serah Terima'
                    ]);
                }
            });

            if ($hospital->level == 'FKRTL') {
                return redirect()->route('home')->with('success', 'Berhasil membuat klaim baru');
            } else {
                return redirect()->route('claim.fktp')->with('success', 'Berhasil membuat klaim baru');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengubah klaim: ' . $e->getMessage());
        }
    }

    public function delete(String $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $claim->delete();
            });

            return redirect()->back()->with('success', 'Berhasil menghapus klaim');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus klaim: ' . $e->getMessage());
        }
    }

    public function approveFinance(String $id)
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
            return redirect()->back()->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveStaff(String $id, Request $request)
    {
        try {
            DB::transaction(function () use ($id, $request) {
                $claim = Claim::find($id);

                $claim->update([
                    'ba_date' => now(),
                    'boa_register_number' => $request->no_reg_boa,
                    'status' => Claim::STATUS_TELAH_REGISTER_BOA,
                ]);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveHead(String $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $date = new DateTime($claim->file_completeness);

                if ($claim->level == 'FKRTL') {
                    $claim->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'completion_limit_date' => $date->modify('+14 days'),
                    ]);
                } else {
                    $claim->update([
                        'ba_date' => now(),
                        'status' => Claim::STATUS_TELAH_SETUJU,
                        'completion_limit_date' => $this->addBusinessDays(Carbon::parse($claim->file_completeness), 14),
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function approveVerificator(String $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);

                if (!$claim) {
                    throw new \Exception('Klaim tidak ditemukan');
                }

                $updateData = ['ba_date' => now()];

                if ($claim->level == 'FKRTL') {
                    if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                        $updateData['status'] = Claim::STATUS_BA_KELENGKAPAN_BERKAS;
                        $updateData['file_completeness'] = now();
                        $updateData['completion_limit_date'] = now()->modify('+9 day');
                    } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS) {
                        $updateData['status'] = Claim::STATUS_BA_HASIL_VERIFIKASI;
                    }
                } else {
                    if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                        $updateData['status'] = Claim::STATUS_BA_KELENGKAPAN_BERKAS;
                        $updateData['file_completeness'] = now();
                        $updateData['completion_limit_date'] = $this->addBusinessDays(now(), 9);
                    } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS) {
                        $updateData['status'] = Claim::STATUS_BA_HASIL_VERIFIKASI;
                    }
                }
                $claim->update($updateData);
            });

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal approve: ' . $e->getMessage());
        }
    }

    public function showHistoryPage()
    {
        $claims = Claim::where('status', Claim::STATUS_TELAH_BAYAR)->get();

        return view('pages.history.history', [
            'claims' => $claims
        ]);
    }

    public function export()
    {
        return Excel::download(new ClaimsExport, 'claims.xlsx');
    }
}

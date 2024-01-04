<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClaimRequest;
use App\Models\Claim;
use App\Models\Hospital;
use DateTime;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::transaction(function () use ($data) {
                $text = $data['nama_rs'];
                $parts = explode("-", $text);
                $rs_name = trim($parts[1]);
                $date = new DateTime($data['tanggal_ba']);
                $userUid = auth()->user()->uuid;

                Claim::create([
                    // 'user_uuid' => $userUid,
                    'hospital_name' => $rs_name,
                    'claim_type' => $data['jenis_claim'],
                    'month' => $data['bulan'] . ' ' . $data['tahun'],
                    'created_date' => $data['tanggal_ba'],
                    'ba_date' => $data['tanggal_ba'],
                    'completion_limit_date' => $date->modify('+9 day'),
                    'status' => 'BA Serah Terima'
                ]);
            });

            return redirect()->route('home')->with('success', 'Berhasil membuat klaim baru');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal membuat klaim baru: ' . $e->getMessage());
        }
    }

    public function delete(String $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $claim->delete();
            });

            return redirect()->route('home')->with('success', 'Berhasil menghapus klaim');
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

    public function approveHead(String $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $claim = Claim::find($id);
                $date = new DateTime($claim->file_completeness);

                $claim->update([
                    'ba_date' => now(),
                    'status' => Claim::STATUS_TELAH_REGISTER_BOA,
                    'completion_limit_date' => $date->modify('+14 days'),
                ]);
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

                if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                    $updateData['status'] = Claim::STATUS_BA_KELENGKAPAN_BERKAS;
                    $updateData['file_completeness'] = now();
                    $updateData['completion_limit_date'] = now()->modify('+9 day');
                } elseif ($claim->status == Claim::STATUS_BA_KELENGKAPAN_BERKAS) {
                    $updateData['status'] = Claim::STATUS_BA_HASIL_VERIFIKASI;
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
}

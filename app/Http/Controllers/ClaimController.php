<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;
use DateTime;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function showCreatePage()
    {
        $hospitals = Hospital::all();
        return view('pages.claim.create-claim', [
            'hospitals' => $hospitals
        ]);
    }

    public function createProcess(Request $request)
    {
        $data = $request->all();

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute yang diinput sudah terdaftar',
        ];

        $this->validate($request, [
            'nama_rs' => 'required',
            'tingkat' => 'required',
            'jenis_claim' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'tanggal_ba' => 'required',
        ], $messages);

        try {
            $text = $request->nama_rs;
            $parts = explode("-", $text);
            $rs_name = trim($parts[1]);
            $date = new DateTime($data['tanggal_ba']);

            Claim::create([
                'hospital_name' => $rs_name,
                'claim_type' => $data['jenis_claim'],
                'month' => $data['bulan'] . ' ' . $data['tahun'],
                'created_date' => $data['tanggal_ba'],
                'ba_date' => $data['tanggal_ba'],
                'completion_limit_date' => $date->modify('+9 day'),
                'status' => 'BA Serah Terima'
            ]);

            return redirect()->route('home')->with('success', 'Berhasil membuat klaim baru');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat klaim baru');
        }
    }

    public function delete(String $id)
    {
        $claim = Claim::find($id);
        $claim->delete();

        if ($claim) {
            return redirect()->route('home')->with('success', 'Berhasil menghapus klaim');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus klaim');
        }
    }

    public function approveFinance(String $id)
    {
        try {
            $claim = Claim::find($id);
            $claim->update([
                'ba_date' => now(),
                'status' => 'Pembayaran Telah Dilakukan'
            ]);
            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal approve');
        }
    }

    public function approveHead(String $id)
    {
        try {
            $claim = Claim::find($id);
            $date = new DateTime($claim->file_completeness);

            $claim->update([
                'ba_date' => now(),
                'status' => 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)',
                'completion_limit_date' => $date->modify('+14 days'),
            ]);
            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal approve');
        }
    }

    public function approveVerificator(String $id)
    {
        try {
            $claim = Claim::find($id);

            if ($claim->status == "BA Serah Terima") {
                $claim->update([
                    'ba_date' => now(),
                    'status' => "BA Kelengkapan Berkas",
                    'file_completeness' => now(),
                    'completion_limit_date' => now()->modify('+9 day'),
                ]);
            } elseif ($claim->status == "BA Kelengkapan Berkas") {
                $claim->update([
                    'ba_date' => now(),
                    'status' => "BA Hasil Verifikasi",
                ]);
            }

            return redirect()->back()->with('success', 'Berhasil approve');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal approve');
        }
    }

    public function showHistoryPage()
    {
        $claims = Claim::where('status', 'Pembayaran Telah Dilakukan')->get();

        return view('pages.history.history', [
            'claims' => $claims
        ]);
    }
}

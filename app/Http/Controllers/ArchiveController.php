<?php

namespace App\Http\Controllers;

use App\Exports\ArchiveExport;
use App\Models\Archive;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class ArchiveController extends Controller
{
    public function index()
    {
        $archives = Archive::all();
        return view('pages.archive.archive', [
            'archives' => $archives,
        ]);
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $archiveNumber = Archive::all()->last();
        if ($archiveNumber == null) {
            $archiveNumber = 'P-001';
        } else {
            $prefix = substr($archiveNumber->dos_number, 0, 2);
            $number = substr($archiveNumber->dos_number, 2);

            $number = intval($number) + 1;

            $archiveNumber = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
        }

        return view('pages.archive.create-archive', [
            'hospitals' => $hospitals,
            'archive_number' => $archiveNumber,
        ]);
    }

    public function store(Request $request)
    {
        $archives = [];

        $counter = 1;
        while ($request->has('judul_berkas_' . $counter)) {
            $hospital = Hospital::where('name', trim($request->input('nama_rs_' . $counter)))->first();
            $hospitalUuid = $hospital->uuid;
            $hospitalName = trim($request->input('nama_rs_' . $counter));
            $hospital = Hospital::where('name', $hospitalName)->firstOrFail();

            $judulBerkas = $request->input('judul_berkas_' . $counter);
            $bulan = $request->input('bulan_' . $counter);
            $tahun = $request->input('tahun_' . $counter);

            $archives[] = [
                'uuid' => Uuid::uuid7(),
                'hospital_uuid' => $hospitalUuid,
                'unit_name' => $request->input('unit_pengolah'),
                'archive_number' => $request->input('nomor_berkas'),
                'dos_number' => $request->input('nomor_dos'),
                'archive_title' => $judulBerkas,
                'classification_code' => $request->input('kode_klasifikasi_' . $counter),
                'hospital_name' => $hospital->name,
                'month' => $bulan,
                'year' => $tahun,
                'description' => $request->input('keterangan_' . $counter),
                'file_content_information' => 'Berkas Klaim ' . $judulBerkas . ' ' . $hospital->name . ' ' . $bulan . ' ' . $tahun,
            ];
            $counter++;
        }

        try {
            DB::transaction(function () use ($archives) {
                Archive::insert($archives);
            });
            return redirect()->route('archive')->with('success', 'Berhasil menambahkan arsip');
        } catch (\Throwable $e) {
            return redirect()->route('archive')->with('error', 'Gagal menambahkan arsip: ' . $e->getMessage());
        }
    }

    public function excel()
    {
        return Excel::download(new ArchiveExport, 'movie-arsip.xlsx');
    }
}

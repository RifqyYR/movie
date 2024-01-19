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
    public function index(Request $request)
    {
        $archives = Archive::query();

        if ($request->has('year') && $request->year != null) {
            $archives->where('year', $request->year);
        }

        if (!$request->has('isActive') || $request->isActive == 'active') {
            $archives->where('status', 'AKTIF');
        } elseif ($request->isActive == 'inactive') {
            $archives->where('status', 'INAKTIF');
        }

        $archives = $archives->get();

        return view('pages.archive.archive', compact('archives'));
    }

    public function numToMonth($month)
    {
        if ($month == '01') {
            return 'Januari';
        } elseif ($month == '02') {
            return 'Februari';
        } elseif ($month == '03') {
            return 'Maret';
        } elseif ($month == '04') {
            return 'April';
        } elseif ($month == '05') {
            return 'Mei';
        } elseif ($month == '06') {
            return 'Juni';
        } elseif ($month == '07') {
            return 'Juli';
        } elseif ($month == '08') {
            return 'Agustus';
        } elseif ($month == '09') {
            return 'September';
        } elseif ($month == '10') {
            return 'Oktober';
        } elseif ($month == '11') {
            return 'November';
        } elseif ($month == '12') {
            return 'Desember';
        }
        return '';
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
            if ($judulBerkas == 'Rawat Jalan Tingkat Lanjutan') {
                $activeSchedule = 1;
            } else {
                $activeSchedule = 2;
            }
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
                'active_retention_schedule' => $activeSchedule,
            ];
            $counter++;
        }

        try {
            DB::transaction(function () use ($archives) {
                Archive::insert($archives);
            });
            return redirect()
                ->route('archive')
                ->with('success', 'Berhasil menambahkan arsip');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan arsip: ' . $e->getMessage());
        }
    }

    public function edit(string $uid)
    {
        $archive = Archive::where('uuid', $uid)->first();
        $hospitals = Hospital::all();

        return view('pages.archive.edit-archive', [
            'archive' => $archive,
            'hospitals' => $hospitals,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        try {
            DB::transaction(function () use ($data) {
                $archive = Archive::where('uuid', $data['uuid'])->first();
                $hospital = Hospital::where('name', trim($data['nama_rs']))->first();

                $hospitalUuid = $hospital->uuid;
                $hospitalName = trim($data['nama_rs']);
                $hospital = Hospital::where('name', $hospitalName)->firstOrFail();

                $judulBerkas = $data['judul_berkas'];

                if ($judulBerkas == 'Rawat Jalan Tingkat Lanjutan') {
                    $activeSchedule = 1;
                } else {
                    $activeSchedule = 2;
                }

                $bulan = $data['bulan'];
                $tahun = $data['tahun'];

                $archive->update([
                    'hospital_uuid' => $hospitalUuid,
                    'unit_name' => $data['unit_pengolah'],
                    'archive_number' => $data['nomor_berkas'],
                    'dos_number' => $data['nomor_dos'],
                    'archive_title' => $judulBerkas,
                    'classification_code' => $data['kode_klasifikasi'],
                    'hospital_name' => $hospital->name,
                    'month' => $bulan,
                    'year' => $tahun,
                    'description' => $data['keterangan'],
                    'file_content_information' => 'Berkas Klaim ' . $judulBerkas . ' ' . $hospital->name . ' ' . $bulan . ' ' . $tahun,
                    'active_retention_schedule' => $activeSchedule,
                ]);
            });

            return redirect()
                ->route('archive')
                ->with('success', 'Berhasil mengedit arsip');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengedit arsip: ' . $e->getMessage());
        }
    }

    public function excel()
    {
        return Excel::download(new ArchiveExport(), 'movie-arsip.xlsx');
    }

    public function checkInactiveArchive()
    {
        $archives = Archive::all();

        foreach ($archives as $archive) {
            $month = $archive->month;
            $year = $archive->year;
            if ($this->numToMonth(date('m')) == $month && date('Y') == $year + $archive->active_retention_schedule) {
                $archive->update([
                    'status' => "INAKTIF",
                ]);
            }
        }
    }
}

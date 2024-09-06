<?php

namespace App\Http\Controllers;

use App\Exports\ArchiveExport;
use App\Helpers\ArchiveNumberGenerator;
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

        if ($request->has('location') && $request->location !== null) {
            $archives->where('location', $request->location);
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
        // $archiveNumber = Archive::all()->last();
        // if ($archiveNumber == null) {
        //     $archiveNumber = 'P-001';
        // } else {
        //     $prefix = substr($archiveNumber->dos_number, 0, 2);
        //     $number = substr($archiveNumber->dos_number, 2);

        //     $number = intval($number) + 1;

        //     $archiveNumber = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
        // }
        $archiveNumber = ArchiveNumberGenerator::generateUniqueArchiveNumber();

        return view('pages.archive.create-archive', [
            'hospitals' => $hospitals,
            'archive_number' => $archiveNumber,
        ]);
    }

    public function store(Request $request)
    {
        $retentionPeriods = [
            'Rawat Jalan Tingkat Pertama' => 2,
            'Rawat Jalan Tingkat Lanjutan' => 1,
            'Rawat Inap Tingkat Pertama dan Persalinan' => 2,
            'Rawat Inap Tingkat Lanjutan' => 2,
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama' => 2,
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan' => 2,
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama' => 2,
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan' => 2,
            'Promotif dan Preventif' => 2,
            'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya' => 2,
            'Sosialisasi kepada peserta dan non peserta' => 2,
            'Pengaduan peserta' => 2,
            'Laporan Pelaksanaan Kegiatan Penyuluhan/Sosialisasi Daerah' => 2,
            'Laporan Penanganan Keluhan Daerah' => 2,
            'Laporan Kunjungan ke Daerah dalam Bentuk Bimbingan Teknis dan Supervisi' => 2,
            'Laporan Kinerja Perluasan Kepesertaan' => 2,
            'Daftar Isian Peserta berserta dengan Lampirannya' => 1,
            'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan' => 2,
            'Penyediaan Perangkat Pendukung Administrasi Kepesertaan' => 2,
            'Registrasi Peserta' => 3,
            'Registrasi Peserta Pekerja Penerima Upah' => 3,
            'Registrasi Peserta Pekerja Bukan Penerima Upah' => 3,
            'Registrasi Peserta Penerima Bantuan Iuran' => 3,
            'Registrasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => 3,
            'Mutasi Peserta Pekerja Penerima Upah' => 3,
            'Mutasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => 3,
            'Sosialisasi kepada peserta dan non peserta' => 2,
            'Workshop/Penyuluhan/Konsinyasi/Focus Group Discussion (Internal dan Eksternal)' => 2,
            'Pelaksanaan Pengelolaan Data dan Pemberian Informasi dengan Kementerian/Lembaga Pemilik Data' => 2,
            'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan' => 2,
            'Penyediaan Perangkat Pendukung Administrasi Kepesertaan' => 2,
            'Pemeriksaan Rutin (Eksternal)' => 3,
            'Eksternal' => 2,
            'Rencana Usulan Kegiatan' => 3,
            'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya' => 2,
            'Dokumen Kredentialing/Rekredentialing' => 1,
            'Usulan Kebutuhan Pengadaan' => 2,
            'Perencanaan Pengadaan' => 3,
            'Daftar Rekanan Perusahaan Terseleksi' => 0,  // Selama menjadi rekanan
            'Barang Inventaris Kantor' => 2,
            'Peralatan Gedung' => 2,
            'Alat Angkutan (Roda Empat dan Roda Dua)' => 2,
            'Komputer' => 2,
            'Barang Ekstra Kompatibel' => 2,
            'Jasa Konsultan' => 3,
            'Sewa-Menyewa' => 2,
            'Barang Bergerak' => 2,
            'Barang Tidak Bergerak' => 2,
            'Aset Bergerak' => 3,
            'Aset Tidak Bergerak' => 3,
            'Administrasi Pengelolaan Barang Habis Pakai' => 2,
            'Administrasi Pengelolaan Belanja Barang Modal' => 2,
            'Swakelola' => 2,
            'Penerimaan' => 1,
            'Kesehatan' => 2,
            'Hukuman' => 1,
            'Pensiun' => 1,
            'Pemberhentian' => 1,
            'Surat Pernyataan Melaksanakan Tugas Pegawai' => 2,
            'Kenaikan Golongan/Grade/Skala Gaji' => 2,
            'Kliping Koran/Majalah/Buletin Info Badan Penyelanggara Jaminan Sosial Kesehatan' => 1,
            'Permintaan Informasi/Data Mahasiswa' => 2,
            'Permintaan Informasi/Data Kementerian/Lembaga' => 2,
            'Izin Penelitian Ditujukan untuk Eksternal' => 2,
            'Buku Tamu' => 1,
            'Memorandum of Understanding/Nota Kesepahaman antara Badan Penyelenggara Jaminan Sosial Kesehatan dengan Kementerian/Lembaga' => 1,
            'Perjanjian Kerja Sama (PKS) antar Lembaga/Instansi Lain' => 1,
            'Pencatatan' => 2,
            'Pendistribusian' => 2,
            'Peminjaman' => 2,
            'Penyimpanan Arsip' => 2,
            'Program Arsip Vital' => 2,
            'Pemusnahan Arsip yang Tidak Bernilai Guna' => 1,
            'Penyusunan Anggaran' => 2,
            'Berita Acara Rekonsiliasi' => 3,
            'Pembayaran klaim Puskesmas/kapitasi/Dokter Keluarga/Apotek dan Optik' => 3,
            'Pembayaran klaim Rumah Sakit' => 3,
            'Pembayaran Biaya Pembinaan' => 3,
            'Perpajakan' => 3,
            'Laporan Keuangan Unaudited' => 3,
            'Iuran Jaminan Kesehatan Nasional (JKN) bukti pendukungnya.' => 3,
            'Tagihan' => 3,
            'Penetapan/Kontrak Kinerja' => 2,
            'Laporan Pengelolaan Program' => 2,
            'Pemantauan, Evaluasi, Penilaian, dan Pelaporan Perencanaan Tahunan (APC)' => 1,
            'Pemeriksaan Kepatuhan' => 2,
        ];

        $archives = [];
        $now = now()->year;

        // Get all input keys that start with 'judul_berkas_'
        $archiveKeys = collect($request->all())->filter(function ($value, $key) {
            return strpos($key, 'judul_berkas_') === 0;
        })->keys();

        $unitName = $request->input('unit_pengolah');

        foreach ($archiveKeys as $key) {
            $counter = substr($key, strlen('judul_berkas_'));

            $judulBerkas = $request->input("judul_berkas_{$counter}");
            $activeSchedule = ($judulBerkas == 'Rawat Jalan Tingkat Lanjutan') ? 1 : 2;

            $bulan = $request->input("bulan_{$counter}");
            $tahun = $request->input("tahun_{$counter}");

            // Default active schedule
            $activeSchedule = 2; // Default 2 years if not found

            // Check if the title exists in the retention period mapping
            if (array_key_exists($judulBerkas, $retentionPeriods)) {
                $activeSchedule = $retentionPeriods[$judulBerkas];
            }

            if ($activeSchedule == 0) {
                $status = 'AKTIF';
            } else {
                // Calculate the status based on the active retention schedule
                $status = ($now - $tahun >= $activeSchedule) ? 'INAKTIF' : 'AKTIF';
            }

            $archiveData = [
                'uuid' => Uuid::uuid7(),
                'unit_name' => $unitName,
                'archive_number' => $request->input('nomor_berkas'),
                'dos_number' => ArchiveNumberGenerator::generateUniqueArchiveNumber(),
                'archive_title' => $judulBerkas,
                'classification_code' => $request->input("kode_klasifikasi_{$counter}"),
                'month' => $bulan,
                'year' => $tahun,
                'description' => $request->input("keterangan_{$counter}"),
                'active_retention_schedule' => $activeSchedule,
                'status' => $status,
            ];

            // Check if hospital name field is not disabled and has a value
            $hospitalName = trim($request->input("nama_rs_{$counter}", ''));
            if ($hospitalName !== '') {
                $hospital = Hospital::where('name', $hospitalName)->first();
                if ($hospital) {
                    $archiveData['hospital_uuid'] = $hospital->uuid;
                    $archiveData['hospital_name'] = $hospital->name;
                }
            } else {
                $archiveData['hospital_uuid'] = null;
                $archiveData['hospital_name'] = null;
            }

            // Set file_content_information based on unit_name
            if ($unitName === 'PMU') {
                $hospitalInfo = isset($archiveData['hospital_name']) ? " {$archiveData['hospital_name']}" : '';
                $archiveData['file_content_information'] = "Berkas Klaim {$judulBerkas}{$hospitalInfo} {$bulan} {$tahun}";
            } else {
                $hospitalInfo = $archiveData['hospital_name'] !== null ? " {$archiveData['hospital_name']}" : '';
                $archiveData['file_content_information'] = "Berkas {$judulBerkas}{$hospitalInfo} {$bulan} {$tahun}";
            }

            $archives[] = $archiveData;
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
        $relatedArchives = Archive::where('dos_number', $archive->dos_number)->get();
        $hospitals = Hospital::all();

        return view('pages.archive.edit-archive', [
            'archives' => $relatedArchives,
            'hospitals' => $hospitals,
        ]);
    }

    public function update(Request $request)
    {
        $retentionPeriods = [
            'Rawat Jalan Tingkat Pertama' => 2,
            'Rawat Jalan Tingkat Lanjutan' => 1,
            'Rawat Inap Tingkat Pertama dan Persalinan' => 2,
            'Rawat Inap Tingkat Lanjutan' => 2,
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama' => 2,
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan' => 2,
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama' => 2,
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan' => 2,
            'Promotif dan Preventif' => 2,
            'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya' => 2,
            'Sosialisasi kepada peserta dan non peserta' => 2,
            'Pengaduan peserta' => 2,
            'Laporan Pelaksanaan Kegiatan Penyuluhan/Sosialisasi Daerah' => 2,
            'Laporan Penanganan Keluhan Daerah' => 2,
            'Laporan Kunjungan ke Daerah dalam Bentuk Bimbingan Teknis dan Supervisi' => 2,
            'Laporan Kinerja Perluasan Kepesertaan' => 2,
            'Daftar Isian Peserta berserta dengan Lampirannya' => 1,
            'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan' => 2,
            'Penyediaan Perangkat Pendukung Administrasi Kepesertaan' => 2,
            'Registrasi Peserta' => 3,
            'Registrasi Peserta Pekerja Penerima Upah' => 3,
            'Registrasi Peserta Pekerja Bukan Penerima Upah' => 3,
            'Registrasi Peserta Penerima Bantuan Iuran' => 3,
            'Registrasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => 3,
            'Mutasi Peserta Pekerja Penerima Upah' => 3,
            'Mutasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => 3,
            'Sosialisasi kepada peserta dan non peserta' => 2,
            'Workshop/Penyuluhan/Konsinyasi/Focus Group Discussion (Internal dan Eksternal)' => 2,
            'Pelaksanaan Pengelolaan Data dan Pemberian Informasi dengan Kementerian/Lembaga Pemilik Data' => 2,
            'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan' => 2,
            'Penyediaan Perangkat Pendukung Administrasi Kepesertaan' => 2,
            'Pemeriksaan Rutin (Eksternal)' => 3,
            'Eksternal' => 2,
            'Rencana Usulan Kegiatan' => 3,
            'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya' => 2,
            'Dokumen Kredentialing/Rekredentialing' => 1,
            'Usulan Kebutuhan Pengadaan' => 2,
            'Perencanaan Pengadaan' => 3,
            'Daftar Rekanan Perusahaan Terseleksi' => 0,  // Selama menjadi rekanan
            'Barang Inventaris Kantor' => 2,
            'Peralatan Gedung' => 2,
            'Alat Angkutan (Roda Empat dan Roda Dua)' => 2,
            'Komputer' => 2,
            'Barang Ekstra Kompatibel' => 2,
            'Jasa Konsultan' => 3,
            'Sewa-Menyewa' => 2,
            'Barang Bergerak' => 2,
            'Barang Tidak Bergerak' => 2,
            'Aset Bergerak' => 3,
            'Aset Tidak Bergerak' => 3,
            'Administrasi Pengelolaan Barang Habis Pakai' => 2,
            'Administrasi Pengelolaan Belanja Barang Modal' => 2,
            'Swakelola' => 2,
            'Penerimaan' => 1,
            'Kesehatan' => 2,
            'Hukuman' => 1,
            'Pensiun' => 1,
            'Pemberhentian' => 1,
            'Surat Pernyataan Melaksanakan Tugas Pegawai' => 2,
            'Kenaikan Golongan/Grade/Skala Gaji' => 2,
            'Kliping Koran/Majalah/Buletin Info Badan Penyelanggara Jaminan Sosial Kesehatan' => 1,
            'Permintaan Informasi/Data Mahasiswa' => 2,
            'Permintaan Informasi/Data Kementerian/Lembaga' => 2,
            'Izin Penelitian Ditujukan untuk Eksternal' => 2,
            'Buku Tamu' => 1,
            'Memorandum of Understanding/Nota Kesepahaman antara Badan Penyelenggara Jaminan Sosial Kesehatan dengan Kementerian/Lembaga' => 1,
            'Perjanjian Kerja Sama (PKS) antar Lembaga/Instansi Lain' => 1,
            'Pencatatan' => 2,
            'Pendistribusian' => 2,
            'Peminjaman' => 2,
            'Penyimpanan Arsip' => 2,
            'Program Arsip Vital' => 2,
            'Pemusnahan Arsip yang Tidak Bernilai Guna' => 1,
            'Penyusunan Anggaran' => 2,
            'Berita Acara Rekonsiliasi' => 3,
            'Pembayaran klaim Puskesmas/kapitasi/Dokter Keluarga/Apotek dan Optik' => 3,
            'Pembayaran klaim Rumah Sakit' => 3,
            'Pembayaran Biaya Pembinaan' => 3,
            'Perpajakan' => 3,
            'Laporan Keuangan Unaudited' => 3,
            'Iuran Jaminan Kesehatan Nasional (JKN) bukti pendukungnya.' => 3,
            'Tagihan' => 3,
            'Penetapan/Kontrak Kinerja' => 2,
            'Laporan Pengelolaan Program' => 2,
            'Pemantauan, Evaluasi, Penilaian, dan Pelaporan Perencanaan Tahunan (APC)' => 1,
            'Pemeriksaan Kepatuhan' => 2,
        ];

        $archivesData = $request->input('archives');
        $now = now()->year;

        try {
            foreach ($archivesData as $uuid => $data) {
                $archive = Archive::where('uuid', $uuid)->first();
                $unitName = $archive->unit_name;

                if ($archive) {
                    $judulBerkas = $data['archive_title'];

                    $activeSchedule = ($judulBerkas == 'Rawat Jalan Tingkat Lanjutan') ? 1 : 2;

                    $bulan = $data['month'];
                    $tahun = $data['year'];

                    $activeSchedule = 2;

                    if (array_key_exists($judulBerkas, $retentionPeriods)) {
                        $activeSchedule = $retentionPeriods[$judulBerkas];
                    }

                    if ($activeSchedule == 0) {
                        $status = 'AKTIF';
                    } else {
                        $status = ($now - $tahun >= $activeSchedule) ? 'INAKTIF' : 'AKTIF';
                    }

                    $data['status'] = $status;
                    $data['active_retention_schedule'] = $activeSchedule;

                    if (isset($data['hospital_name'])) {
                        $hospital = Hospital::where('name', $data['hospital_name'])->first();
                        if ($hospital) {
                            $data['hospital_uuid'] = $hospital->uuid;
                            $data['hospital_name'] = $hospital->name;
                        }

                        if ($unitName === 'PMU') {
                            $hospitalInfo = isset($data['hospital_name']) ? " {$data['hospital_name']}" : '';
                            $data['file_content_information'] = "Berkas Klaim {$judulBerkas}{$hospitalInfo} {$bulan} {$tahun}";
                        } else {
                            $hospitalInfo = isset($data['hospital_name']) ? " {$data['hospital_name']}" : '';
                            $data['file_content_information'] = "Berkas {$judulBerkas}{$hospitalInfo} {$bulan} {$tahun}";
                        }
                    } else {
                        $data['file_content_information'] = "Berkas {$judulBerkas} {$bulan} {$tahun}";
                    }

                    $archive->update($data);
                }
            }

            return redirect()
                ->route('archive')
                ->with('success', 'Berhasil mengedit arsip');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengedit arsip: ' . $e->getMessage());
        }
    }

    public function updateLocation(Request $request)
    {
        // Find the archive using the provided archive_id
        $archive = Archive::where('uuid', $request->archive_uuid)->first();

        // Check if the archive exists
        if ($archive) {
            // Find all archives with the same dos_number
            $archivesWithSameDos = Archive::where('dos_number', $archive->dos_number)->get();

            // Update the location for all archives with the same dos_number
            foreach ($archivesWithSameDos as $archiveItem) {
                $archiveItem->location = $request->location;
                $archiveItem->save();
            }

            return redirect()->route('archive')->with('success', 'Berhasil mengubah lokasi gudang');
        }

        return redirect()->route('archive')->with('error', 'Arsip tidak ditemukan');
    }

    public function excel()
    {
        return Excel::download(new ArchiveExport(), 'movie-arsip.xlsx');
    }

    public function delete($uuid)
    {
        $archive = Archive::where('uuid', $uuid)->first();

        try {
            $archive->delete();
            return redirect()
                ->route('archive')
                ->with('success', 'Berhasil menghapus arsip');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus arsip: ' . $e->getMessage());
        }
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

<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArchiveExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $retentionMapping = [
            'Rawat Jalan Tingkat Pertama' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Rawat Jalan Tingkat Lanjutan' => [
                'aktif' => '1 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Rawat Inap Tingkat Pertama dan Persalinan' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Rawat Inap Tingkat Lanjutan' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Promotif dan Preventif' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya' => [
                'aktif' => '2 Tahun setelah kegiatan dipertanggungjawabkan/ diaudit',
                'inaktif' => '',
            ],
            'Sosialisasi kepada peserta dan non peserta' => [
                'aktif' => '2 Tahun',
                'inaktif' => '',
            ],
            'Pengaduan peserta' => [
                'aktif' => '2 Tahun',
                'inaktif' => '',
            ],
            'Laporan Pelaksanaan Kegiatan Penyuluhan/Sosialisasi Daerah' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Laporan Penanganan Keluhan Daerah' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Laporan Kunjungan ke Daerah dalam Bentuk Bimbingan Teknis dan Supervisi' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Laporan Kinerja Perluasan Kepesertaan' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Daftar Isian Peserta berserta dengan Lampirannya' => [
                'aktif' => '1 Tahun Setelah Diperbaharui',
                'inaktif' => '',
            ],
            'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan' => [
                'aktif' => '2 Tahun Setelah Diperbaharui',
                'inaktif' => '',
            ],
            'Penyediaan Perangkat Pendukung Administrasi Kepesertaan' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Registrasi Peserta' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Registrasi Peserta Pekerja Penerima Upah' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Registrasi Peserta Pekerja Bukan Penerima Upah' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Registrasi Peserta Penerima Bantuan Iuran' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Registrasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Mutasi Peserta Pekerja Penerima Upah' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Mutasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah' => [
                'aktif' => '3 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Sosialisasi kepada peserta dan non peserta' => [
                'aktif' => '2 Tahun',
                'inaktif' => '',
            ],
            'Workshop/Penyuluhan/Konsinyasi/Focus Group Discussion (Internal dan Eksternal)' => [
                'aktif' => '2 Tahun',
                'inaktif' => '',
            ],
            'Pelaksanaan Pengelolaan Data dan Pemberian Informasi dengan Kementerian/Lembaga Pemilik Data' => [
                'aktif' => '2 Tahun',
                'inaktif' => '',
            ],
            'Pemeriksaan Rutin (Eksternal)' => [
                'aktif' => '3 Tahun setelah tindak lanjut selesai',
                'inaktif' => '2 Tahun',
            ],
            'Eksternal' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun setelah tindak lanjut selesai',
            ],
            'Rencana Usulan Kegiatan' => [
                'aktif' => '3 Tahun setelah Rencana Kerja Anggaran Pendapatan disahkan',
                'inaktif' => '',
            ],
            'Dokumen Kredentialing/Rekredentialing' => [
                'aktif' => '1 tahun',
                'inaktif' => '2 Tahun',
            ],
            'Usulan Kebutuhan Pengadaan' => [
                'aktif' => '2 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Barang Inventaris Kantor' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Peralatan Gedung' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Alat Angkutan (Roda Empat dan Roda Dua)' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Komputer' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Barang Ekstra Kompatibel' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Jasa Konsultan' => [
                'aktif' => '3 Tahun setelah pelaksanaan',
                'inaktif' => '5 Tahun',
            ],
            'Sewa-Menyewa' => [
                'aktif' => '2 Tahun setelah diaudit',
                'inaktif' => '2 Tahun setelah penghapusan',
            ],
            'Barang Bergerak' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Barang Tidak Bergerak' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Aset Bergerak' => [
                'aktif' => '3 Tahun setelah laporan keuangan disahkan',
                'inaktif' => '7 Tahun',
            ],
            'Aset Tidak Bergerak' => [
                'aktif' => '3 Tahun setelah laporan keuangan disahkan',
                'inaktif' => '7 Tahun',
            ],
            'Administrasi Pengelolaan Barang Habis Pakai' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Administrasi Pengelolaan Belanja Barang Modal' => [
                'aktif' => '2 Tahun',
                'inaktif' => '8 Tahun',
            ],
            'Swakelola' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Penerimaan' => [
                'aktif' => '1 Tahun setelah diaudit',
                'inaktif' => '2 Tahun',
            ],
            'Kesehatan' => [
                'aktif' => '2 Tahun setelah tidak menjadi pegawai Badan Penyelenggara Jaminan Sosial Kesehatan',
                'inaktif' => '2 Tahun',
            ],
            'Hukuman' => [
                'aktif' => '1 Tahun anggaran berjalan',
                'inaktif' => '2 Tahun',
            ],
            'Pensiun' => [
                'aktif' => '1 Tahun setelah memperoleh Keputusan bersifat tetap',
                'inaktif' => '2 Tahun setelah hak dan kewajiban selesai',
            ],
            'Pemberhentian' => [
                'aktif' => '1 Tahun setelah memperoleh Keputusan bersifat tetap',
                'inaktif' => '2 Tahun setelah hak dan kewajiban selesai',
            ],
            'Surat Pernyataan Melaksanakan Tugas Pegawai' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Kenaikan Golongan/Grade/Skala Gaji' => [
                'aktif' => '2 Tahun setelah mutasi',
                'inaktif' => '-',
            ],
            'Kliping Koran/Majalah/ Buletin Info Badan Penyelanggara Jaminan Sosial Kesehatan' => [
                'aktif' => '1 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Permintaan Informasi/Data Mahasiswa' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Permintaan Informasi/Data Kementerian/Lembaga' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Izin Penelitian Ditujukan untuk Eksternal' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Buku Tamu' => [
                'aktif' => '1 Tahun',
                'inaktif' => '2 Tahun',
            ],
            'Memorandum of Understanding/Nota Kesepahaman antara Badan Penyelenggara Jaminan Sosial Kesehatan dengan Kementerian/Lembaga' => [
                'aktif' => '1 Tahun setelah Memorandum of Understanding berakhir',
                'inaktif' => '4 Tahun',
            ],
            'Perjanjian Kerja Sama (PKS) antar Lembaga/Instansi Lain' => [
                'aktif' => '1 Tahun setelah Perjanjian Kerja Sama berakhir',
                'inaktif' => '4 Tahun',
            ],
            'Pencatatan' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Pendistribusian' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Peminjaman' => [
                'aktif' => '2 Tahun',
                'inaktif' => '-',
            ],
            'Penyimpanan Arsip' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Program Arsip Vital' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Pemusnahan Arsip yang Tidak Bernilai Guna' => [
                'aktif' => '1 Tahun',
                'inaktif' => '1 Tahun',
            ],
            'Penyusunan Anggaran' => [
                'aktif' => '2 Tahun setelah Tahun anggaran berakhir',
                'inaktif' => '3 Tahun',
            ],
            'Berita Acara Rekonsiliasi' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Pembayaran klaim Puskesmas/kapitasi/Dokter Keluarga/Apotek dan Optik' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Pembayaran klaim Rumah Sakit' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Pembayaran Biaya Pembinaan' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Perpajakan' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Laporan Keuangan Unaudited' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Iuran Jaminan Kesehatan Nasional (JKN) bukti pendukungnya.' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Tagihan' => [
                'aktif' => '3 Tahun setelah Rencana Kerja dan Anggaran disahkan dan tindak lanjut hasil pemeriksaan telah selesai',
                'inaktif' => '7 Tahun',
            ],
            'Penetapan/Kontrak Kinerja' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Laporan Pengelolaan Program' => [
                'aktif' => '2 Tahun',
                'inaktif' => '3 Tahun',
            ],
            'Pemantauan, Evaluasi, Penilaian, dan Pelaporan Perencanaan Tahunan (APC)' => [
                'aktif' => '1 Tahun',
                'inaktif' => '1 Tahun',
            ],
            'Pemeriksaan Kepatuhan' => [
                'aktif' => '2 Tahun setelah pemeriksaan',
                'inaktif' => '5 Tahun',
            ],
        ];
        return Archive::with('hospital')
            ->get()
            ->map(function ($archive) use ($retentionMapping) {
                $mapping = $retentionMapping[$archive->archive_title] ?? ['aktif' => '', 'inaktif' => ''];

                return [
                    'unit_name' => $archive->unit_name,
                    'archive_number' => $archive->archive_number,
                    'dos_number' => $archive->dos_number,
                    'archive_title' => $archive->archive_title,
                    'classification_code' => $archive->classification_code,
                    'hospital_name' => $archive->hospital->name ?? 'Tidak ada',
                    'month' => $archive->month,
                    'year' => $archive->year,
                    'description' => $archive->description,
                    'file_content_information' => $archive->file_content_information,
                    'location' => $archive->location,
                    'active' => $mapping['aktif'],
                    'inactive' => $mapping['inaktif'],
                    'status' => $archive->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Unit Pengolah',
            'Nomor Berkas',
            'Nomor Dos',
            'Judul Berkas',
            'Kode Klasifikasi',
            'Nama Faskes',
            'Bulan',
            'Tahun',
            'Keterangan',
            'Uraian Informasi Berkas',
            'Lokasi Gudang',
            'JRA Aktif',
            'JRA Inaktif',
            'Status',
        ];
    }
}

@extends('layouts.main')

@section('content')
    @php
        $nomorBerkasPMU = [
            ['name' => 'Rawat Jalan Tingkat Pertama', 'code' => 'PK.03.00'],
            ['name' => 'Rawat Jalan Tingkat Lanjutan', 'code' => 'PK.03.02'],
            ['name' => 'Rawat Inap Tingkat Pertama dan Persalinan', 'code' => 'PK.03.01'],
            ['name' => 'Rawat Inap Tingkat Lanjutan', 'code' => 'PK.03.03'],
            ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.04'],
            ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan', 'code' => 'PK.03.05'],
            ['name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.06'],
            [
                'name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan',
                'code' => 'PK.03.07',
            ],
            ['name' => 'Promotif dan Preventif', 'code' => 'PK.03.08'],
            [
                'name' => 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya',
                'code' => 'PK.06.01',
            ],
        ];
        $nomorBerkasYANSER = [
            ['name' => 'Sosialisasi kepada peserta dan non peserta', 'code' => 'PS.03.00'],
            ['name' => 'Pengaduan peserta', 'code' => 'PS.03.02'],
            ['name' => 'Laporan Pelaksanaan Kegiatan Penyuluhan/Sosialisasi Daerah', 'code' => 'PS.04.00'],
            ['name' => 'Laporan Penanganan Keluhan Daerah', 'code' => 'PS.04.01'],
            ['name' => 'Laporan Kunjungan ke Daerah dalam Bentuk Bimbingan Teknis dan Supervisi', 'code' => 'PS.04.02'],
            ['name' => 'Laporan Kinerja Perluasan Kepesertaan', 'code' => 'PS.04.03'],
            ['name' => 'Daftar Isian Peserta berserta dengan Lampirannya', 'code' => 'PS.05'],
            ['name' => 'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan', 'code' => 'PS.07'],
            ['name' => 'Penyediaan Perangkat Pendukung Administrasi Kepesertaan', 'code' => 'PS.08'],
        ];
        $nomorBerkasKEPSER = [
            ['name' => 'Registrasi Peserta', 'code' => 'PS.01.00'],
            ['name' => 'Registrasi Peserta Pekerja Penerima Upah', 'code' => 'PS.01.01'],
            ['name' => 'Registrasi Peserta Pekerja Bukan Penerima Upah', 'code' => 'PS.01.02'],
            ['name' => 'Registrasi Peserta Penerima Bantuan Iuran', 'code' => 'PS.01.03'],
            ['name' => 'Registrasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah', 'code' => 'PS.01.04'],
            ['name' => 'Mutasi Peserta Pekerja Penerima Upah', 'code' => 'PS.02.00'],
            ['name' => 'Mutasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah', 'code' => 'PS.02.03'],
            ['name' => 'Sosialisasi kepada peserta dan non peserta', 'code' => 'PS.03.00'],
            [
                'name' => 'Workshop/Penyuluhan/Konsinyasi/Focus Group Discussion (Internal dan Eksternal)',
                'code' => 'PS.03.01',
            ],
            [
                'name' =>
                    'Pelaksanaan Pengelolaan Data dan Pemberian Informasi dengan Kementerian/Lembaga Pemilik Data',
                'code' => 'PS.03.03',
            ],
            ['name' => 'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan', 'code' => 'PS.07'],
            ['name' => 'Penyediaan Perangkat Pendukung Administrasi Kepesertaan', 'code' => 'PS.08'],
            ['name' => 'Pemeriksaan Rutin (Ekternal)', 'code' => 'PP.00.03'],
            ['name' => 'Eksternal', 'code' => 'PP.02.01'],
        ];
        $nomorBerkasYANFASKES = [
            ['name' => 'Rencana Usulan Kegiatan', 'code' => 'PK.05'],
            [
                'name' => 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya',
                'code' => 'PK.06.01',
            ],
            ['name' => 'Dokumen Kredentialing/Rekredentialing', 'code' => 'PK.06.02'],
            ['name' => 'Pelayanan Kesehatan Primer (Perjanjian Kerja Sama)', 'code' => 'PK.01.00'],
            ['name' => 'Pelayanan Kesehatan Rujukan (Perjanjian Kerja Sama)', 'code' => 'PK.01.01'],
        ];
        $nomorBerkasSDMUK = [
            ['name' => 'Usulan Kebutuhan Pengadaan', 'code' => 'SP.00.00'],
            ['name' => 'Perencanaan Pengadaan', 'code' => 'SP.00.01'],
            ['name' => 'Daftar Rekanan Perusahaan Terseleksi', 'code' => 'SP.00.02'],
            ['name' => 'Barang Inventaris Kantor', 'code' => 'SP.01.02'],
            ['name' => 'Peralatan Gedung', 'code' => 'SP.01.03'],
            ['name' => 'Alat Angkutan (Roda Empat dan Roda Dua)', 'code' => 'SP.01.04'],
            ['name' => 'Komputer', 'code' => 'SP.01.05'],
            ['name' => 'Barang Ekstra Kompatibel', 'code' => 'SP.01.06'],
            ['name' => 'Jasa Konsultan', 'code' => 'SP.02.00'],
            ['name' => 'Sewa-Menyewa', 'code' => 'SP.02.01'],
            ['name' => 'Barang Bergerak', 'code' => 'SP.04.00'],
            ['name' => 'Barang Tidak Bergerak', 'code' => 'SP.04.01'],
            ['name' => 'Aset Bergerak', 'code' => 'SP.06.00'],
            ['name' => 'Aset Tidak Bergerak', 'code' => 'SP.06.01'],
            ['name' => 'Administrasi Pengelolaan Barang Habis Pakai', 'code' => 'SP.07'],
            ['name' => 'Administrasi Pengelolaan Belanja Barang Modal', 'code' => 'SP.08'],
            ['name' => 'Swakelola', 'code' => 'SP.09'],
            ['name' => 'Penerimaan', 'code' => 'KP.01.01'],
            ['name' => 'Kesehatan', 'code' => 'KP.04.01'],
            ['name' => 'Hukuman', 'code' => 'KP.05.03'],
            ['name' => 'Pensiun', 'code' => 'KP.06.00'],
            ['name' => 'Pemberhentian', 'code' => 'KP.06.01'],
            ['name' => 'Surat Pernyataan Melaksanakan Tugas Pegawai', 'code' => 'KP.08.00'],
            ['name' => 'Kenaikan Golongan/Grade/Skala Gaji', 'code' => 'KP.08.01'],
            [
                'name' => 'Kliping Koran/Majalah/Buletin Info Badan Penyelanggara Jaminan Sosial Kesehatan',
                'code' => 'HM.04.00',
            ],
            ['name' => 'Permintaan Informasi/Data Mahasiswa', 'code' => 'HM.06.00'],
            ['name' => 'Permintaan Informasi/Data Kementerian/Lembaga', 'code' => 'HM.06.01'],
            ['name' => 'Izin Penelitian Ditujukan untuk Eksternal', 'code' => 'HM.06.02'],
            ['name' => 'Buku Tamu', 'code' => 'HM.10.01'],
            [
                'name' =>
                    'Memorandum of Understanding/Nota Kesepahaman antara Badan Penyelenggara Jaminan Sosial Kesehatan dengan Kementerian/Lembaga',
                'code' => 'HM.11.02',
            ],
            ['name' => 'Perjanjian Kerja Sama (PKS) antar Lembaga/Instansi Lain', 'code' => 'HM.11.03'],
            ['name' => 'Pencatatan', 'code' => 'KA.00.00'],
            ['name' => 'Pendistribusian', 'code' => 'KA.00.01'],
            ['name' => 'Peminjaman', 'code' => 'KA.01.01'],
            ['name' => 'Penyimpanan Arsip', 'code' => 'KA.02.02'],
            ['name' => 'Program Arsip Vital', 'code' => 'KA.02.04'],
            ['name' => 'Pemusnahan Arsip yang Tidak Bernilai Guna', 'code' => 'KA.04.01'],
        ];
        $nomorBerkasPKP = [
            ['name' => 'Penyusunan Anggaran', 'code' => 'KU.00.00'],
            ['name' => 'Berita Acara Rekonsiliasi', 'code' => 'KU.01.04'],
            ['name' => 'Pembayaran klaim Puskesmas/kapitasi/Dokter Keluarga/Apotek dan Optik', 'code' => 'KU.02.00'],
            ['name' => 'Pembayaran klaim Rumah Sakit', 'code' => 'KU.02.01'],
            ['name' => 'Pembayaran Biaya Pembinaan', 'code' => 'KU.02.03'],
            ['name' => 'Perpajakan', 'code' => 'KU.04'],
            ['name' => 'Laporan Keuangan Unaudited', 'code' => 'KU.07.00'],
            ['name' => 'Iuran Jaminan Kesehatan Nasional (JKN) bukti pendukungnya.', 'code' => 'PI.00.00'],
            ['name' => 'Tagihan', 'code' => 'PI.00.01'],
            ['name' => 'Penetapan/Kontrak Kinerja', 'code' => 'PE.00.02'],
            ['name' => 'Laporan Pengelolaan Program', 'code' => 'PE.00.03'],
            ['name' => 'Pemantauan, Evaluasi, Penilaian, dan Pelaporan Perencanaan Tahunan (APC)', 'code' => 'PE.02'],
            ['name' => 'Pemeriksaan Kepatuhan', 'code' => 'HK.07'],
        ];
    @endphp
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h6 mb-0 text-gray-800 fw-bold" style="color: #fc7f01 !important;">Buat Pengarsipan Baru</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/arsip/proses-buat-arsip" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="table-custom-fs-larger" for="unit_pengolah">Unit Pengolah</label>
                                <select required id="unit_pengolah" class="table-custom-fs form-select" name="unit_pengolah"
                                    @error('unit_pengolah') is-invalid @enderror>
                                    <option value="" selected hidden></option>
                                    <option value="PMU">PMU</option>
                                    <option value="YANSER">YANSER</option>
                                    <option value="KEPSER">KEPSER</option>
                                    <option value="YANFASKES">YANFASKES</option>
                                    <option value="SDMUK">SDMUK</option>
                                    <option value="PKP">PKP</option>
                                </select>
                                @error('unit_pengolah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="table-custom-fs-larger" for="nomor_berkas">Nomor Barcode</label>
                                <input required id="nomor_berkas" type="text" class="table-custom-fs form-control"
                                    name="nomor_berkas" autocomplete="nomor_berkas"
                                    @error('nomor_berkas') is-invalid @enderror />
                                @error('nomor_berkas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="table-custom-fs-larger" for="nomor_dos">Nomor Dos</label>
                                <input id="nomor_dos" type="text" class="table-custom-fs form-control" name="nomor_dos"
                                    value="{{ $archive_number }}" autocomplete="nomor_dos"
                                    @error('nomor_dos') is-invalid @enderror />
                                @error('nomor_dos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <span class="table-custom-fs-larger mb-0">Berkas Arsip</span>

                    <div id="inputContainer"></div>
                    <button id="addInput" type="button" class="btn btn-sm table-custom-fs btn-success mb-2">Tambah Berkas
                        Arsip</button>

                    <div class="form-group mt-1">
                        <span id="description-alert" class="text-danger table-custom-fs">*Maksimal karakter input deskripsi
                            hanya 30
                            karakter</span>
                        <div class="form-group mt-4 d-flex justify-content-center">
                            <a href="{{ route('archive') }}">
                                <input type="button" class="btn btn-danger me-4 table-custom-fs-larger" value="Kembali"
                                    style="width: 5rem;">
                            </a>
                            <input type="submit" class="btn btn-success table-custom-fs-larger" value="Buat"
                                style="width: 5rem;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

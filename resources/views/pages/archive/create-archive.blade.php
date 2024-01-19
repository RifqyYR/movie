@extends('layouts.main')

@section('content')
    @php
        $nomorBerkas = [['name' => 'Rawat Jalan Tingkat Pertama', 'code' => 'PK.03.00'], ['name' => 'Rawat Jalan Tingkat Lanjutan', 'code' => 'PK.03.02'], ['name' => 'Rawat Inap Tingkat Pertama dan Persalinan', 'code' => 'PK.03.01'], ['name' => 'Rawat Inap Tingkat Lanjutan', 'code' => 'PK.03.03'], ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.04'], ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan', 'code' => 'PK.03.05'], ['name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.06'], ['name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan', 'code' => 'PK.03.07'], ['name' => 'Promotif dan Preventif', 'code' => 'PK.03.08'], ['name' => 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya', 'code' => 'PK.06.01']];
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
            <h1 class="h6 mb-0 text-gray-800 fw-bold" style="color: #fc7f01 !important;">Buat Klaim Baru</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/arsip/proses-buat-arsip" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="table-custom-fs-larger" for="unit_pengolah">Unit Pengolah</label>
                                <input id="unit_pengolah" type="text" class="table-custom-fs form-control"
                                    name="unit_pengolah" autocomplete="unit_pengolah"
                                    @error('unit_pengolah') is-invalid @enderror />
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
                                <input id="nomor_berkas" type="text" class="table-custom-fs form-control"
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
                                    value="{{ $archive_number }}" autocomplete="nomor_dos" readonly
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

@extends('layouts.main')

@section('content')
    @php
        $nomorBerkas = [['name' => 'Rawat Jalan Tingkat Pertama', 'code' => 'PK.03.00'], ['name' => 'Rawat Jalan Tingkat Lanjutan', 'code' => 'PK.03.02'], ['name' => 'Rawat Inap Tingkat Pertama dan Persalinan', 'code' => 'PK.03.01'], ['name' => 'Rawat Inap Tingkat Lanjutan', 'code' => 'PK.03.03'], ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.04'], ['name' => 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan', 'code' => 'PK.03.05'], ['name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama', 'code' => 'PK.03.06'], ['name' => 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan', 'code' => 'PK.03.07'], ['name' => 'Promotif dan Preventif', 'code' => 'PK.03.08'], ['name' => 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya', 'code' => 'PK.06.01']];
    @endphp
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h6 mb-0 text-gray-800 fw-bold" style="color: #fc7f01 !important;">Edit Arsip</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/arsip/proses-edit-arsip" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="table-custom-fs-larger" for="unit_pengolah">Unit Pengolah</label>
                                <input id="unit_pengolah" type="text" class="table-custom-fs form-control"
                                    name="unit_pengolah" autocomplete="unit_pengolah" value="{{ $archive->unit_name }}"
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
                                    name="nomor_berkas" autocomplete="nomor_berkas" value="{{ $archive->archive_number }}"
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
                                    value="{{ $archive->dos_number }}" autocomplete="nomor_dos"
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

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-3">
                                <select
                                    class="custom-select text-truncate table-custom-fs @error('judul_berkas') is-invalid @enderror"
                                    name="judul_berkas">
                                    <option selected hidden value="{{ $archive->archive_title }}">
                                        {{ $archive->archive_title }}</option>
                                    @foreach ($nomorBerkas as $item)
                                        <option class="table-custom-fs" value="{{ $item['name'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('judul_berkas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <input readonly type="text" class="table-custom-fs text-truncate form-control"
                                    name="kode_klasifikasi" autocomplete="kode_klasifikasi"
                                    value="{{ $archive->classification_code }}"
                                    @error('kode_klasifikasi') is-invalid @enderror placeholder="Kode Klasifikasi" />
                                @error('kode_klasifikasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select table-custom-fs @error('nama_rs') is-invalid @enderror"
                                    name="nama_rs" id="editable-select">
                                    <option selected hidden value="{{ $archive->hospital_name }}">{{ $archive->hospital_name }}</option>
                                    @foreach ($hospitals as $item)
                                        <option class="table-custom-fs" value="{{ trim($item->name) }}">
                                            {{ trim($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('nama_rs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <select class="custom-select table-custom-fs @error('bulan') is-invalid @enderror"
                                    name="bulan">
                                    <option selected hidden value="{{ $archive->month }}">{{ $archive->month }}</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                                @error('bulan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <select class="custom-select table-custom-fs @error('tahun') is-invalid @enderror"
                                    name="tahun">
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}"
                                            {{ $archive->year == $year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="table-custom-fs form-control description-archive"
                                    name="keterangan" autocomplete="keterangan" @error('keterangan') is-invalid @enderror
                                    placeholder="Keterangan" value="{{ $archive->description }}" />
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $archive->uuid }}" name="uuid">
                    <div class="form-group mt-1">
                        <span id="description-alert" class="text-danger table-custom-fs">*Maksimal karakter input
                            deskripsi
                            hanya 30
                            karakter</span>
                        <div class="form-group mt-4 d-flex justify-content-center">
                            <a href="{{ route('archive') }}">
                                <input type="button" class="btn btn-danger me-4 table-custom-fs-larger" value="Kembali"
                                    style="width: 5rem;">
                            </a>
                            <input type="submit" class="btn btn-success table-custom-fs-larger" value="Edit"
                                style="width: 5rem;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

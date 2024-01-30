@extends('layouts.main')

@section('content')
    @php
        $routeFrom = Illuminate\Support\Facades\Session::get('routeFrom');

        if ($routeFrom == 'fktp') {
            $select1 = ['Non Kapitasi', 'Alkes', 'Apotek PRB'];
        } else {
            $select1 = ['Pelayanan', 'Apotek Kronis', 'Ambulance', 'Alkes'];
        }

        $select2 = ['Reguler', 'Susulan', 'Dispute', 'Pending'];

        $selectOptions = [];
        foreach ($select1 as $a) {
            foreach ($select2 as $b) {
                $selectOptions[] = $a . ' ' . $b;
            }
        }

        if ($routeFrom == 'fktp') {
            array_push($selectOptions, 'Promotif Preventif');
            array_push($selectOptions, 'Kegiatan Kelompok');
        }
    @endphp
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h6 mb-0 text-gray-800 fw-bold" style="color: #fc7f01 !important;">{{ $routeFrom == 'fktp' ? "Buat Klaim FKTP Baru" : "Buat Klaim FKRTL Baru" }}</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/claim/proses-buat-claim" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_rs" class="table-custom-fs-larger">Nama Faskes</label>
                        <select class="custom-select table-custom-fs @error('nama_rs') is-invalid @enderror" name="nama_rs"
                            id="editable-select">
                            <option selected hidden value=""></option>
                            @foreach ($hospitals as $item)
                                <option class="table-custom-fs" value="{{ $item->name }}">{{ $item->code . ' - ' . $item->name }}</option>
                            @endforeach
                        </select>
                        @error('nama_rs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_claim" class="table-custom-fs-larger">Jenis Klaim</label>
                        <select class="custom-select table-custom-fs @error('jenis_claim') is-invalid @enderror"
                            name="jenis_claim" id="editable-select">
                            <option selected hidden value=""></option>
                            @foreach ($selectOptions as $item)
                                <option class="table-custom-fs" value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('jenis_claim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="bulan" class="table-custom-fs-larger">Bulan Pelayanan</label>
                            <select class="custom-select table-custom-fs @error('bulan') is-invalid @enderror"
                                name="bulan">
                                <option selected hidden value="">Bulan...</option>
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
                        <div class="form-group col-md-4">
                            <label for="tahun" class="table-custom-fs-larger">Tahun Pelayanan</label>
                            <select class="custom-select table-custom-fs @error('tahun') is-invalid @enderror"
                                name="tahun">
                                <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                            </select>
                            @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_ba" class="table-custom-fs-larger">Tanggal Pembuatan BA</label>
                            <input type="date"
                                class="form-control table-custom-fs @error('tanggal_ba') is-invalid @enderror"
                                name="tanggal_ba" value="{{ now()->toDateString() }}" autocomplete="off"
                                max="{{ now()->toDateString() }}">
                            @error('tanggal_ba')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <input name="route" type="hidden" value="{{ $routeFrom }}">

                    <div class="form-group mt-4 d-flex justify-content-center">
                        <a href="{{ url()->previous() }}">
                            <input type="button" class="btn btn-danger me-4 table-custom-fs-larger" value="Kembali"
                                style="width: 5rem;">
                        </a>
                        <input type="submit" class="btn btn-success table-custom-fs-larger" value="Buat"
                            style="width: 5rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    @php
        $select1 = ['Pelayanan', 'Apotek Kronis', 'Apotek PRB', 'Ambulance', 'Alkes', 'Non Kapitasi'];
        $select2 = ['Reguler', 'Susulan', 'Dispute', 'Pending'];

        $selectOptions = [];
        foreach ($select1 as $a) {
            foreach ($select2 as $b) {
                $selectOptions[] = $a . ' ' . $b;
            }
        }

        array_push($selectOptions, 'Promotif Preventif');
    @endphp
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h6 mb-0 text-gray-800 fw-bold">Buat Klaim Baru</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/claim/proses-buat-claim" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_rs">Nama Faskes</label>
                        <select class="custom-select @error('nama_rs') is-invalid @enderror" name="nama_rs"
                            id="editable-select">
                            <option selected hidden value=""></option>
                            @foreach ($hospitals as $item)
                                <option value="{{ $item->name }}">{{ $item->code . ' - ' . $item->name }}</option>
                            @endforeach
                        </select>
                        @error('nama_rs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tingkat">Tingkat</label>
                        <select class="custom-select @error('tingkat') is-invalid @enderror" name="tingkat">
                            <option selected hidden value="">Tingkat...</option>
                            <option value="FKRTL">FKRTL</option>
                            <option value="FKTP" disabled>FKTP</option>
                        </select>
                        @error('tingkat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_claim">Jenis Klaim</label>
                        <select class="custom-select @error('jenis_claim') is-invalid @enderror" name="jenis_claim"
                            id="editable-select">
                            <option selected hidden value=""></option>
                            @foreach ($selectOptions as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
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
                            <label for="bulan">Bulan</label>
                            <select class="custom-select @error('bulan') is-invalid @enderror" name="bulan">
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
                            <label for="tahun">Tahun</label>
                            <select class="custom-select @error('tahun') is-invalid @enderror" name="tahun">
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
                            <label for="tanggal_ba">Tanggal Pembuatan BA</label>
                            <input type="date" class="form-control @error('tanggal_ba') is-invalid @enderror"
                                name="tanggal_ba" value="{{ now()->toDateString() }}" autocomplete="off">
                            @error('tanggal_ba')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-4 d-flex justify-content-center">
                        <input type="submit" class="btn btn-success" value="Buat">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

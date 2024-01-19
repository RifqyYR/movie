@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Faskes') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/proses-tambah-faskes">
                            @csrf

                            <div class="row mb-3">
                                <label for="nama_faskes"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Nama Faskes') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_faskes" type="text"
                                        class="form-control @error('nama_faskes') is-invalid @enderror" name="nama_faskes"
                                        value="{{ old('nama_faskes') }}" required autocomplete="nama_faskes" autofocus>

                                    @error('nama_faskes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="kode_faskes"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Kode Faskes') }}</label>

                                <div class="col-md-6">
                                    <input id="kode_faskes" type="text"
                                        class="form-control @error('kode_faskes') is-invalid @enderror" name="kode_faskes"
                                        value="{{ old('kode_faskes') }}" required autocomplete="kode_faskes" autofocus>

                                    @error('kode_faskes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tingkat"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tingkat') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="tingkat">
                                        <option selected value="FKRTL">FKRTL</option>
                                        <option value="FKTP">FKTP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="wilayah"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Wilayah') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="wilayah">
                                        <option selected value="ParePare">Pare Pare</option>
                                        <option value="Barru">Barru</option>
                                        <option value="Pinrang">Pinrang</option>
                                        <option value="Sidrap">Sidrap</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('faskes') }}">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            Kembali
                                        </button>
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #2E3192">
                                        Tambah Faskes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

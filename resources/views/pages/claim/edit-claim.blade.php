@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h6 mb-0 text-gray-800 fw-bold" style="color: #fc7f01 !important;">Edit Klaim</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="/claim/edit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tanggal_pembuatan_ba" class="table-custom-fs-larger">Tanggal Pembuatan BA
                                (BAST)</label>
                            <input type="date"
                                class="form-control table-custom-fs @error('tanggal_pembuatan_ba') is-invalid @enderror"
                                name="tanggal_pembuatan_ba" value="{{ $claim->created_date }}" autocomplete="off" max="{{ now()->toDateString() }}" {{ auth()->user()->role == 'STAFF_ADMIN' ? 'disabled' : '' }}>
                            @error('tanggal_pembuatan_ba')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_kelengkapan_ba" class="table-custom-fs-larger">Tanggal Kelengkapan
                                BA (BAKB)</label>
                            <input type="date"
                                class="form-control table-custom-fs @error('tanggal_kelengkapan_ba') is-invalid @enderror"
                                name="tanggal_kelengkapan_ba" value="{{ $claim->file_completeness }}" autocomplete="off" max="{{ now()->toDateString() }}" {{ auth()->user()->role == 'STAFF_ADMIN' ? 'disabled' : '' }}>
                            @error('tanggal_kelengkapan_ba')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status" class="table-custom-fs-larger">Status</label>
                            <select id="edit-status" class="custom-select table-custom-fs @error('status') is-invalid @enderror"
                                name="status" {{ auth()->user()->role == 'STAFF_ADMIN' ? 'disabled' : '' }}>
                                <option selected hidden value="{{ $claim->status }}">{{ $claim->status }}</option>
                                <option value="{{ App\Models\Claim::STATUS_BA_SERAH_TERIMA }}">
                                    {{ App\Models\Claim::STATUS_BA_SERAH_TERIMA }}</option>
                                <option value="{{ App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS }}">
                                    {{ App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS }}</option>
                                <option value="{{ App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI }}">
                                    {{ App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI }}</option>
                                <option value="{{ App\Models\Claim::STATUS_TELAH_REGISTER_BOA }}">
                                    {{ App\Models\Claim::STATUS_TELAH_REGISTER_BOA }}</option>
                                <option value="{{ App\Models\Claim::STATUS_TELAH_SETUJU }}">
                                    {{ App\Models\Claim::STATUS_TELAH_SETUJU }}</option>
                                <option value="{{ App\Models\Claim::STATUS_TELAH_BAYAR }}">
                                    {{ App\Models\Claim::STATUS_TELAH_BAYAR }}</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <label class="table-custom-fs-larger form-edit-register-boa">Nomor Register BOA</label>
                    <div class="form-row form-edit-register-boa">
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <span class="table-custom-fs input-group-text">RI</span>
                                <input type="text" class="table-custom-fs form-control" name="no_reg_boa_ri" value="{{ $claim->ritl_number }}"
                                    placeholder="Masukkan Nomor Registrasi BOA RI" autocomplete="no_reg_boa_ri"
                                    @error('no_reg_boa_ri') is-invalid @enderror />
                                @error('no_reg_boa_ri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <span class="table-custom-fs input-group-text">RJ</span>
                                <input type="text" class="table-custom-fs form-control" name="no_reg_boa_rj" value="{{ $claim->rjtl_number }}"
                                    placeholder="Masukkan Nomor Registrasi BOA RJ" autocomplete="no_reg_boa_rj"
                                    @error('no_reg_boa_rj') is-invalid @enderror />
                                @error('no_reg_boa_rj')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="{{ $claim->uuid }}">

                    <div class="form-group mt-4 d-flex justify-content-center">
                        <a href="{{ url()->previous() }}">
                            <input type="button" class="btn btn-danger me-4 table-custom-fs-larger" value="Kembali"
                                style="width: 5rem;">
                        </a>
                        <input type="submit" class="btn btn-success table-custom-fs-larger" value="Edit"
                            style="width: 5rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

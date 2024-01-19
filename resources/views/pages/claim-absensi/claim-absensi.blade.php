@extends('layouts.main')

@section('content')
    <div class="px-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-2">
                <div class="card card-pare" style="border-radius: 14px; border: 2px solid black;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title fs-6 fw-bold text-start " style="z-index: 1;">Kota Parepare</h5>
                        <img src="{{ url('pare.png') }}" alt="Peta Kota Pare-Pare" class="mb-1 img-pare mx-auto"
                            style="max-height: 7rem;">
                        <div class="row mt-4 mx-auto">
                            <div class="col-md-6 mb-2">
                                <a href="/absensi-fkrtl/pare">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKRTL (Non Inacbg)</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="/absensi-fktp/pare">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKTP (Non Kapitasi)</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-barru" style="border-radius: 14px; border: 2px solid black;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title fs-6 fw-bold text-start">Kab. Barru</h5>
                        <img src="{{ url('barru.png') }}" style="max-height: 7rem;" alt="Peta Kabupaten Barru"
                            class="mb-1 img-barru mx-auto">
                        <div class="row mt-4 mx-auto">
                            <div class="col-md-6 mb-2">
                                <a href="/absensi-fkrtl/barru">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKRTL (Non Inacbg)</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="/absensi-fktp/barru">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKTP (Non Kapitasi)</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-2">
                <div class="card card-sidrap" style="border-radius: 14px; border: 2px solid black;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title fs-6 fw-bold text-start" style="z-index: 1;">Kab. Sidenreng Rappang</h5>
                        <img src="{{ url('sidrap.png') }}" alt="Peta Kabupaten Sidenreng Rappang"
                            class="mb-1 img-sidrap mx-auto" style="max-height: 7rem;">
                        <div class="row mt-4 mx-auto">
                            <div class="col-md-6 mb-2">
                                <a href="/absensi-fkrtl/sidrap">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKRTL (Non Inacbg)</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="/absensi-fktp/sidrap">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKTP (Non Kapitasi)</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-pinrang" style="border-radius: 14px; border: 2px solid black;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title fs-6 fw-bold text-start" style="z-index: 1;">Kab. Pinrang</h5>
                        <img src="{{ url('pinrang.png') }}" style="max-height: 7rem;" alt="Peta Kabupaten Pinrang"
                            class="mb-1 img-pinrang mx-auto">
                        <div class="row mt-4 mx-auto">
                            <div class="col-md-6 mb-2">
                                <a href="/absensi-fkrtl/pinrang">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKRTL (Non Inacbg)</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="/absensi-fktp/pinrang">
                                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold text-nowrap"
                                        style="font-size: 0.75rem;">FKTP (Non Kapitasi)</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

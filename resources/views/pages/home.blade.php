@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body px-4 py-0">
                        <div class="fw-bold" style="color: #2E3192 !important; font-size: 0.9rem !important;">Kota Pare-Pare
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-auto my-auto">
                                <canvas id="pie-chart-pare"></canvas>
                            </div>
                            <div class="col-md-8 mx-auto my-auto">
                                <canvas id="bar-chart-fkrtl-pare" height="110px"></canvas>
                                <canvas id="bar-chart-fktp-pare" height="110px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body px-4 py-0">
                        <div class="fw-bold" style="color: #2E3192 !important; font-size: 0.9rem !important;">Kab. Barru
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-auto my-auto">
                                <canvas id="pie-chart-barru"></canvas>
                            </div>
                            <div class="col-md-8 mx-auto my-auto">
                                <canvas id="bar-chart-fkrtl-barru" height="110px"></canvas>
                                <canvas id="bar-chart-fktp-barru" height="110px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body px-4 py-0">
                        <div class="fw-bold" style="color: #2E3192 !important; font-size: 0.9rem !important;">Kab. Sidenreng
                            Rappang</div>
                        <div class="row">
                            <div class="col-md-3 mx-auto my-auto">

                                <canvas id="pie-chart-sidrap"></canvas>

                            </div>
                            <div class="col-md-8 mx-auto my-auto">
                                <canvas id="bar-chart-fkrtl-sidrap" height="110px"></canvas>
                                <canvas id="bar-chart-fktp-sidrap" height="110px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body px-4 py-0">
                        <div class="fw-bold" style="color: #2E3192 !important; font-size: 0.9rem !important;">Kab. Pinrang
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-auto my-auto">
                                <canvas id="pie-chart-pinrang"></canvas>
                            </div>
                            <div class="col-md-8 mx-auto my-auto">
                                <canvas id="bar-chart-fkrtl-pinrang" height="110px"></canvas>
                                <canvas id="bar-chart-fktp-pinrang" height="110px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-5 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="title fs-6" style="color: #fc7f01 !important;">Kota Pare-Pare - Total Faskes Kerjasama: <b>32</b></div>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="chart-pie">
                                    <canvas id="pie-chart-pare"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7 mx-auto my-auto">
                                <canvas id="bar-chart-pare" height="400px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title fs-6" style="color: #fc7f01 !important;">Kab. Barru - Total Faskes Kerjasama: <b>28</b></div>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="chart-pie">
                                    <canvas id="pie-chart-barru"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7 mx-auto my-auto">
                                <canvas id="bar-chart-barru" height="400px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="title fs-6" style="color: #fc7f01 !important;">Kab. Sidrap - Total Faskes Kerjasama: <b>32</b></div>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="chart-pie">
                                    <canvas id="pie-chart-sidrap"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7 mx-auto my-auto">
                                <canvas id="bar-chart-sidrap" height="400px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title fs-6" style="color: #fc7f01 !important;">Kab. Pinrang - Total Faskes Kerjasama: <b>43</b></div>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="chart-pie">
                                    <canvas id="pie-chart-pinrang"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7 mx-auto my-auto">
                                <canvas id="bar-chart-pinrang" height="400px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

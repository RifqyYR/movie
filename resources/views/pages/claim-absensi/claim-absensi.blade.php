@extends('layouts.main')

@section('content')
    @php
        function monthToNum($month)
        {
            if ($month == 'Januari') {
                return 1;
            } elseif ($month == 'Februari') {
                return 2;
            } elseif ($month == 'Maret') {
                return 3;
            } elseif ($month == 'April') {
                return 4;
            } elseif ($month == 'Mei') {
                return 5;
            } elseif ($month == 'Juni') {
                return 6;
            } elseif ($month == 'Juli') {
                return 7;
            } elseif ($month == 'Agustus') {
                return 8;
            } elseif ($month == 'September') {
                return 9;
            } elseif ($month == 'Oktober') {
                return 10;
            } elseif ($month == 'November') {
                return 11;
            } elseif ($month == 'Desember') {
                return 12;
            }
            return 0;
        }

        function getAbsensi($hospital_name, $claim_type, $object)
        {
            foreach ($object as $key => $data) {
                $locale = 'id_ID';
                $date = new DateTime(now());
                $dateFormatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);

                if ($data->hospital_name == $hospital_name && $data->claim_type == $claim_type) {
                    $parts = explode(' ', $dateFormatter->format($date));
                    $parts2 = explode(' ', $data->month);

                    $monthNow = monthToNum(trim($parts[1]));
                    $monthItem = monthToNum(trim($parts2[0]));

                    $yearNow = $parts[2];
                    $yearItem = $parts2[1];
                    if ($yearNow > $yearItem) {
                        $monthNow = $monthNow + 12;
                        $absensiKlaim = abs($monthItem - $monthNow);
                    }
                    $absensiKlaim = abs($monthItem - $monthNow);

                    return $absensiKlaim;
                }
            }
            return null;
        }

        $pare = $claims['Parepare'];
        $barru = $claims['Barru'];
        $pinrang = $claims['Pinrang'];
        $sidrap = $claims['Sidrap'];
    @endphp
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Dashboard Absensi Klaim</h1>
        </div>
        <div class="row">
            {{-- Left Table --}}
            <div class="col-md-6">
                {{-- Table ParePare --}}
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3" class="text-center align-middle blue-thead">Pare Pare</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle green-thead">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle green-thead">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle green-thead">Absensi (Reguler)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][0]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][0]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][0]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][0]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][1]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][1]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][1]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr
                            class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][1]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][2]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][2]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][2]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][2]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][3]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][3]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][3]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][3]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][4]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][4]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][4]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][4]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][5]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][5]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][5]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][5]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][6]->name, 'Pelayanan Reguler', $pare);
                            $absensiKlaimApotek = getAbsensi($hospitals['ParePare'][6]->name, 'Apotek Kronis Reguler', $pare);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['ParePare'][6]->name, 'Ambulance Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['ParePare'][6]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][7]->name, 'Alkes Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['ParePare'][7]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][8]->name, 'Alkes Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['ParePare'][8]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][9]->name, 'Alkes Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['ParePare'][9]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['ParePare'][10]->name, 'Alkes Reguler', $pare);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['ParePare'][10]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Right Table --}}
            <div class="col-md-6">
                {{-- Table Barru --}}
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3" class="text-center align-middle blue-thead">Barru</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle green-thead">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle green-thead">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle green-thead text-nowrap">Absensi (Reguler)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Barru'][0]->name, 'Pelayanan Reguler', $barru);
                            $absensiKlaimApotek = getAbsensi($hospitals['Barru'][0]->name, 'Apotek Kronis Reguler', $barru);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Barru'][0]->name, 'Ambulance Reguler', $barru);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Barru'][0]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Barru'][1]->name, 'Pelayanan Reguler', $barru);
                            $absensiKlaimApotek = getAbsensi($hospitals['Barru'][1]->name, 'Apotek Kronis Reguler', $barru);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Barru'][1]->name, 'Ambulance Reguler', $barru);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Barru'][1]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Barru'][2]->name, 'Pelayanan Reguler', $barru);
                            $absensiKlaimApotek = getAbsensi($hospitals['Barru'][2]->name, 'Apotek Kronis Reguler', $barru);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Barru'][2]->name, 'Ambulance Reguler', $barru);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Barru'][2]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Barru'][3]->name, 'Alkes Reguler', $barru);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['Barru'][3]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Table Pinrang --}}
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3" class="text-center align-middle blue-thead">Pinrang</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle green-thead">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle green-thead">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle green-thead text-nowrap">Absensi (Reguler)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Pinrang'][0]->name, 'Pelayanan Reguler', $pinrang);
                            $absensiKlaimApotek = getAbsensi($hospitals['Pinrang'][0]->name, 'Apotek Kronis Reguler', $pinrang);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Pinrang'][0]->name, 'Ambulance Reguler', $pinrang);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Pinrang'][0]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Pinrang'][1]->name, 'Pelayanan Reguler', $pinrang);
                            $absensiKlaimApotek = getAbsensi($hospitals['Pinrang'][1]->name, 'Apotek Kronis Reguler', $pinrang);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Pinrang'][1]->name, 'Ambulance Reguler', $pinrang);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Pinrang'][1]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Pinrang'][2]->name, 'Pelayanan Reguler', $pinrang);
                            $absensiKlaimApotek = getAbsensi($hospitals['Pinrang'][2]->name, 'Apotek Kronis Reguler', $pinrang);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Pinrang'][2]->name, 'Ambulance Reguler', $pinrang);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Pinrang'][2]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Pinrang'][3]->name, 'Alkes Reguler', $pinrang);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['Pinrang'][3]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Pinrang'][4]->name, 'Alkes Reguler', $pinrang);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['Pinrang'][4]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Table Sidrap --}}
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3" class="text-center align-middle blue-thead">Sidrap</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle green-thead">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle green-thead">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle green-thead text-nowrap">Absensi (Reguler)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Sidrap'][0]->name, 'Pelayanan Reguler', $sidrap);
                            $absensiKlaimApotek = getAbsensi($hospitals['Sidrap'][0]->name, 'Apotek Kronis Reguler', $sidrap);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Sidrap'][0]->name, 'Ambulance Reguler', $sidrap);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Sidrap'][0]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Sidrap'][1]->name, 'Pelayanan Reguler', $sidrap);
                            $absensiKlaimApotek = getAbsensi($hospitals['Sidrap'][1]->name, 'Apotek Kronis Reguler', $sidrap);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Sidrap'][1]->name, 'Ambulance Reguler', $sidrap);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Sidrap'][1]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Sidrap'][2]->name, 'Pelayanan Reguler', $sidrap);
                            $absensiKlaimApotek = getAbsensi($hospitals['Sidrap'][2]->name, 'Apotek Kronis Reguler', $sidrap);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Sidrap'][2]->name, 'Ambulance Reguler', $sidrap);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Sidrap'][2]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Sidrap'][2]->name, 'Pelayanan Reguler', $sidrap);
                            $absensiKlaimApotek = getAbsensi($hospitals['Sidrap'][2]->name, 'Apotek Kronis Reguler', $sidrap);
                            $absensiKlaimAmbulance = getAbsensi($hospitals['Sidrap'][2]->name, 'Ambulance Reguler', $sidrap);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px; background-color: white;"
                                rowspan="3">
                                {{ $hospitals['Sidrap'][2]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Pelayanan Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimApotek >= 2 && $absensiKlaimApotek < 3 ? 'table-warning' : ($absensiKlaimApotek >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Apotek Kronis Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimApotek }}</td>
                        </tr>
                        <tr class="{{ $absensiKlaimAmbulance >= 2 && $absensiKlaimAmbulance < 3 ? 'table-warning' : ($absensiKlaimAmbulance >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold" style="font-size: 14px;">Ambulance Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimAmbulance }}</td>
                        </tr>

                        @php
                            $absensiKlaimPelayanan = getAbsensi($hospitals['Sidrap'][3]->name, 'Alkes Reguler', $sidrap);
                        @endphp
                        <tr class="{{ $absensiKlaimPelayanan >= 2 && $absensiKlaimPelayanan < 3 ? 'table-warning' : ($absensiKlaimPelayanan >= 3 ? 'table-danger' : '') }}">
                            <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                {{ $hospitals['Sidrap'][3]->name }}
                            </td>
                            <td class="align-middle fw-bold" style="font-size: 14px;">Alkes Reguler</td>
                            <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                N-{{ $absensiKlaimPelayanan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

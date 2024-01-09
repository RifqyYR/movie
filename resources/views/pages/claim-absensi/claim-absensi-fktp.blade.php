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
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Dashboard Absensi Klaim FKTP</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr id="thead-pare">
                            <th scope="col" colspan="3" class="text-center align-middle blue-thead rounded-top-4 transparent-th">Pare Pare</th>
                        </tr>
                        <tr class="table-toggle">
                            <th scope="col" class="text-center align-middle green-thead">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle green-thead">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle green-thead">Absensi (Reguler)</th>
                        </tr>
                    </thead>
                    <tbody class="table-toggle">
                        @php
                            $claimTypes = [
                                'Pelayanan Reguler' => 'absensiKlaimPelayanan',
                                'Apotek PRB Reguler' => 'absensiKlaimApotek',
                                'Non Kapitasi Reguler' => 'absensiKlaimAmbulance',
                            ];
                        @endphp
                        @foreach ($hospitals['ParePare'] as $hospital)
                            @php
                                $absensi = [
                                    'absensiKlaimPelayanan' => getAbsensi($hospital->name, 'Pelayanan Reguler', $pare),
                                    'absensiKlaimApotek' => getAbsensi($hospital->name, 'Apotek PRB Reguler', $pare),
                                    'absensiKlaimAmbulance' => getAbsensi($hospital->name, 'Non Kapitasi Reguler', $pare),
                                ];
                            @endphp
                            @foreach ($claimTypes as $claimType => $absensiKey)
                                <tr
                                    class="{{ $absensi[$absensiKey] >= 2 && $absensi[$absensiKey] < 3 ? 'table-warning' : ($absensi[$absensiKey] >= 3 ? 'table-danger' : '') }}">
                                    @if ($loop->first)
                                        <td class="align-middle fw-bold text-nowrap"
                                            style="font-size: 14px; background-color: white;"
                                            rowspan="{{ count($claimTypes) }}">
                                            {{ $hospital->name }}
                                        </td>
                                    @endif
                                    <td class="align-middle fw-bold" style="font-size: 14px;">{{ $claimType }}</td>
                                    <td class="align-middle fw-bold text-center text-nowrap" style="font-size: 14px;">
                                        N-{{ $absensi[$absensiKey] }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-bordered-black">

                </table>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
@endsection

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

        $labExist = false;
        $apotekExist = false;

        foreach ($hospitals as $hospital) {
            if ($hospital->name && (str_contains(strtolower((string) $hospital->name), 'apotek') || str_contains(strtolower((string) $hospital->name), 'apotik'))) {
                $apotekExist = true;
                continue;
            }
            if ($hospital->name && (str_contains(strtolower((string) $hospital->name), 'prodia') || str_contains(strtolower((string) $hospital->name), 'laboratorium'))) {
                $labExist = true;
                continue;
            }
        }
    @endphp
    <div class="container">
        <div class="d-sm-flex">
            <a href="{{ route('absent-claim') }}" class="fab-back rounded"
                style="margin-right: 3.5rem; z-index: 1;">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10"
                    viewBox="0 0 320 512">
                    <path fill="#ffffff"
                        d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
            </a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Absensi Klaim FKRTL -
                @if ($region == 'Parepare')
                    Kota Parepare
                @elseif ($region == 'barru')
                    Kabupaten Barru
                @elseif ($region == 'pinrang')
                    Kabupaten Pinrang
                @elseif ($region == 'sidrap')
                    Kabupaten Sidrap
                @endif
            </h1>
        </div>
        <div class="row">
            {{-- Left Table --}}
            <div class="col-md-6">
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3"
                                class="text-center align-middle green-thead table-custom-fs-larger">Faskes
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle custom-col">Nama Faskes</th>
                            <th scope="col" class="text-center align-middle custom-col">Jenis Klaim</th>
                            <th scope="col" class="text-center align-middle custom-col">Absensi (Reguler)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $claimTypes = [
                                'Pelayanan Reguler' => 'absensiKlaimPelayanan',
                                'Apotek Kronis Reguler' => 'absensiKlaimApotek',
                                'Ambulance Reguler' => 'absensiKlaimAmbulance',
                                'Alkes Reguler' => 'absensiKlaimAlkes',
                            ];
                        @endphp
                        @foreach ($hospitals as $hospital)
                            @if ($hospital->name && str_contains(strtolower((string) $hospital->name), 'optik'))
                                @continue
                            @endif
                            @php
                                $absensi = [
                                    'absensiKlaimPelayanan' => getAbsensi($hospital->name, 'Pelayanan Reguler', $claims),
                                    'absensiKlaimApotek' => getAbsensi($hospital->name, 'Apotek Kronis Reguler', $claims),
                                    'absensiKlaimAmbulance' => getAbsensi($hospital->name, 'Ambulance Reguler', $claims),
                                    'absensiKlaimAlkes' => getAbsensi($hospital->name, 'Alkes Reguler', $claims),
                                ];
                            @endphp
                            @foreach ($claimTypes as $claimType => $absensiKey)
                                <tr
                                    class="{{ $absensi[$absensiKey] >= 2 && $absensi[$absensiKey] < 3 ? 'table-warning' : ($absensi[$absensiKey] >= 3 ? 'table-danger' : '') }}">
                                    @if ($loop->first)
                                        <td class="align-middle fw-bold text-nowrap table-custom-fs"
                                            style="background-color: white;" rowspan="{{ count($claimTypes) }}">
                                            {{ $hospital->name }}
                                        </td>
                                    @endif
                                    <td class="align-middle fw-bold table-custom-fs">{{ $claimType }}</td>
                                    <td class="align-middle fw-bold text-center text-nowrap table-custom-fs">
                                        N-{{ $absensi[$absensiKey] }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Right Table --}}
            <div class="col-md-6">
                <table class="table table-sm table-bordered-black">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3"
                                class="text-center align-middle green-thead table-custom-fs-larger">Optik
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center align-middle custom-col text-nowrap">Nama Faskes
                            </th>
                            <th scope="col" class="text-center align-middle custom-col text-nowrap">Jenis Klaim
                            </th>
                            <th scope="col" class="text-center align-middle custom-col text-nowrap">Absensi
                                (Reguler)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $claimTypes = ['Alkes Reguler' => 'absensiKlaimAlkes'];
                        @endphp
                        @foreach ($hospitals as $hospital)
                            @php
                                $absensi = ['absensiKlaimAlkes' => getAbsensi($hospital->name, 'Alkes Reguler', $claims)];
                            @endphp
                            @if ($hospital->name && str_contains(strtolower((string) $hospital->name), 'optik'))
                                @foreach ($claimTypes as $claimType => $absensiKey)
                                    <tr
                                        class="{{ $absensi[$absensiKey] >= 2 && $absensi[$absensiKey] < 3 ? 'table-warning' : ($absensi[$absensiKey] >= 3 ? 'table-danger' : '') }}">
                                        @if ($loop->first)
                                            <td class="align-middle fw-bold table-custom-fs"
                                                rowspan="{{ count($claimTypes) }}">
                                                {{ $hospital->name }}
                                            </td>
                                        @endif
                                        <td class="align-middle fw-bold text-nowrap table-custom-fs">
                                            {{ $claimType }}</td>
                                        <td class="align-middle fw-bold text-center text-nowrap table-custom-fs">
                                            N-{{ $absensi[$absensiKey] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

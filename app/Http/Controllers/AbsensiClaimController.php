<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;
use Carbon\Carbon;

class AbsensiClaimController extends Controller
{
    public function index()
    {
        return view('pages.claim-absensi.claim-absensi');
    }

    function getClaimsFKRTLByRegion($string, $string2, $status, $region)
    {
        return Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->whereNotIn('claim_type', $string2)
            ->where('hospitals.level', 'FKRTL')
            ->where('status', '!=', $status)
            ->where('region', $region)
            ->orderBy('month', 'asc')
            ->get();
    }

    function getClaimsFKTPByRegion($string, $string2, $status, $region)
    {
        return Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->whereNotIn('claim_type', $string2)
            ->where('hospitals.level', 'FKTP')
            ->where('status', '!=', $status)
            ->where('region', $region)
            ->orderBy('month', 'asc')
            ->get();
    }

    public function unique_multidim_array($array, $key)
    {
        $temp_array = [];
        $i = 0;
        $key_array = [];

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];

                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function absensiFKRTL(string $region)
    {
        $string = 'Reguler';
        $string2 = ['Apotek PRB Reguler', 'Non Kapitasi Reguler', 'Promotif Preventif', 'Kegiatan Kelompok'];
        $status = 'Pembayaran Telah Dilakukan';

        if ($region == 'pare') {
            $region = 'Parepare';
        }

        $claims = Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->whereNotIn('claim_type', $string2)
            ->where('hospitals.level', 'FKRTL')
            ->where('region', $region)
            ->orderBy('month', 'asc')
            ->get();

        $hospitals = Hospital::where('level', 'FKRTL')
            ->where('region', $region)
            ->get();

        return view('pages.claim-absensi.fkrtl', [
            'region' => $region,
            'claims' => $claims,
            'hospitals' => $hospitals,
        ]);
    }

    public function absensiFKTP(string $region)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $string2 = ['Apotek Kronis Reguler', 'Ambulance Reguler', 'Pelayanan Reguler'];

        if ($region == 'pare') {
            $region = 'Parepare';
        }

        $claims = Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->whereNotIn('claim_type', $string2)
            ->where('hospitals.level', 'FKTP')
            ->where('region', $region)
            ->get()
            ->sortBy(function ($claim) use ($currentMonth, $currentYear) {
                // Extract month and year from the month field
                $parts = explode(' ', $claim->month);
                $month = $parts[0];
                $year = $parts[1];

                // Map textual month to its numeric value
                $monthMap = [
                    'Januari' => 1,
                    'Februari' => 2,
                    'Maret' => 3,
                    'April' => 4,
                    'Mei' => 5,
                    'Juni' => 6,
                    'Juli' => 7,
                    'Agustus' => 8,
                    'September' => 9,
                    'Oktober' => 10,
                    'November' => 11,
                    'Desember' => 12,
                ];

                // Get the numeric value of the month
                $monthNumber = $monthMap[$month];

                $monthDiff = (($year - $currentYear) * 12) + ($monthNumber - $currentMonth);

                // Return the negative of month difference for reverse sorting
                return -$monthDiff;
            });

        // dd($claims);

        $hospitals = Hospital::where('level', 'FKTP')
            ->where('region', $region)
            ->orderByRaw("CASE WHEN name LIKE 'PKM%' THEN 0 ELSE 1 END")
            ->orderBy('name', 'asc')
            ->get();

        return view('pages.claim-absensi.fktp', [
            'region' => $region,
            'claims' => $claims,
            'hospitals' => $hospitals,
        ]);
    }
}

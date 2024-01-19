<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;

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
            ->where('status', '!=', $status)
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
        $string2 = ['Apotek Kronis Reguler', 'Ambulance Reguler', 'Pelayanan Reguler', 'Pembayaran Telah Dilakukan'];

        if ($region == 'pare') {
            $region = 'Parepare';
        }

        $claims = Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->whereNotIn('claim_type', $string2)
            ->where('hospitals.level', 'FKTP')
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('region', $region)
            ->orderBy('month', 'asc')
            ->get();

        $hospitals = Hospital::where('level', 'FKTP')
            ->where('region', $region)
            ->get();

        return view('pages.claim-absensi.fktp', [
            'region' => $region,
            'claims' => $claims,
            'hospitals' => $hospitals,
        ]);
    }
}

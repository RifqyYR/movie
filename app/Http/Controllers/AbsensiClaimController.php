<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;

class AbsensiClaimController extends Controller
{
    public function index()
    {
        $string = 'Reguler';
        $string2 = ['Apotek PRB Reguler', 'Alkes Reguler', 'Non Kapitasi Reguler'];
        $status = 'Pembayaran Telah Dilakukan';
        $pare = Claim::join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->whereNotIn('claim_type', $string2)
            ->where('status', '!=', $status)
            ->where('region', 'ParePare')
            ->orderBy('hospital_name')
            ->get();
        $barru = Claim::join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->where('claim_type', '!=', $string2)
            ->where('status', '!=', $status)
            ->where('region', 'Barru')
            ->orderBy('hospital_name')
            ->get();
        $pinrang = Claim::join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->where('claim_type', '!=', $string2)
            ->where('status', '!=', $status)
            ->where('region', 'Pinrang')
            ->orderBy('hospital_name')
            ->get();
        $sidrap = Claim::join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->where('claim_type', '!=', $string2)
            ->where('status', '!=', $status)
            ->where('region', 'Sidrap')
            ->orderBy('hospital_name')
            ->get();

        $hospitals = Hospital::all();
        $hospitals = $hospitals->groupBy('region');
        // $groupedData = $pare->groupBy('hospital_name');

        // $formattedData = [];
        // foreach ($groupedData as $hospitalName => $claims) {
        //     $formattedData[] = [
        //         'name' => $hospitalName,
        //         'claims' => $claims->map(function ($claim) {
        //             return [
        //                 'month' => $claim->month,
        //                 'type' => $claim->claim_type,
        //             ];
        //         })->toArray(),
        //     ];
        // }

        return view('pages.claim-absensi.claim-absensi', [
            'pare' => $pare,
            'hospitals' => $hospitals,
            'barru' => $barru,
            'sidrap' => $sidrap,
            'pinrang' => $pinrang,
        ]);
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
}

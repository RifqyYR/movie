<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;
use Illuminate\Support\Facades\Cache;

class AbsensiClaimController extends Controller
{
    public function index()
    {
        $string = 'Reguler';
        $string2 = ['Apotek PRB Reguler', 'Alkes Reguler', 'Non Kapitasi Reguler'];
        $status = 'Pembayaran Telah Dilakukan';

        $regions = ['Parepare', 'Barru', 'Pinrang', 'Sidrap'];
        $claims = [];

        foreach ($regions as $region) {
            $claims[$region] = Cache::remember("claims.$region", 0, function () use ($string, $string2, $status, $region) {
                return $this->getClaimsByRegion($string, $string2, $status, $region);
            });
        }

        $hospitals = Cache::remember('hospitals', 60, function () {
            return Hospital::all()->groupBy('region');
        });

        $claims = array_merge($claims, ['hospitals' => $hospitals]);

        return view(
            'pages.claim-absensi.claim-absensi',
            [
                'claims' => $claims,
                'hospitals' => $hospitals,
            ]
        );
    }

    function getClaimsByRegion($string, $string2, $status, $region)
    {
        return Claim::with('hospital')
            ->join('hospitals', 'hospitals.name', '=', 'claims.hospital_name')
            ->where('claim_type', 'LIKE', '%' . $string . '%')
            ->whereNotIn('claim_type', $string2)
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function fkrtl(Request $request)
    {
        $claims = $this->getClaims('FKRTL', $request->status);

        return view('pages.fkrtl', [
            'claims' => $claims,
        ]);
    }

    public function fktp(Request $request)
    {
        $claims = $this->getClaims('FKTP', $request->status);

        return view('pages.fktp', [
            'claims' => $claims,
        ]);
    }

    private function getClaims($level, $status)
    {
        $query = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', $level)
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')
            ->orderBy('claims.updated_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    public function getDataPie()
    {
        $keywords = ['optik', 'apotik', 'apotek', 'laboratorium', 'prodia'];

        $hospitals = Hospital::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('name', 'NOT LIKE', '%' . $keyword . '%');
            }
        })
            ->get()
            ->groupBy('region');
        $allowedType = ['Pelayanan Reguler', 'Non Kapitasi Reguler'];

        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->whereIn('claim_type', $allowedType)
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.region')
            ->orderBy('claims.updated_at', 'desc')
            ->get()
            ->groupBy('hospital_uuid')
            ->map(function ($claims) {
                return $claims->first();
            })
            ->groupBy('hospital.region');

        return response()->json([
            'hospitals' => $hospitals,
            'claims' => $claims,
        ]);
    }

    public function getDataBarFKRTL()
    {
        $keywords = ['optik', 'apotik', 'apotek', 'laboratorium', 'prodia'];

        $hospitals = Hospital::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('name', 'NOT LIKE', '%' . $keyword . '%')->where('level', 'FKRTL');
            }
        })
            ->get()
            ->groupBy('region');
        $allowedType = 'Pelayanan Reguler';

        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('claim_type', $allowedType)
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', 'FKRTL')
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.region')
            ->orderBy('claims.updated_at', 'desc')
            ->get()
            ->groupBy('hospital_uuid')
            ->map(function ($claims) {
                return $claims->first();
            })
            ->groupBy('hospital.region');

        return response()->json([
            'hospitals' => $hospitals,
            'claims' => $claims,
        ]);
    }

    public function getDataBarFKTP()
    {
        $keywords = ['optik', 'apotik', 'apotek', 'laboratorium', 'prodia'];

        $hospitals = Hospital::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('name', 'NOT LIKE', '%' . $keyword . '%')->where('level', 'FKTP');
            }
        })
            ->get()
            ->groupBy('region');
        $allowedType = 'Non Kapitasi Reguler';

        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('claim_type', $allowedType)
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', 'FKTP')
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.region')
            ->orderBy('claims.updated_at', 'desc')
            ->get()
            ->groupBy('hospital_uuid')
            ->map(function ($claims) {
                return $claims->first();
            })
            ->groupBy('hospital.region');

        return response()->json([
            'hospitals' => $hospitals,
            'claims' => $claims,
        ]);
    }
}

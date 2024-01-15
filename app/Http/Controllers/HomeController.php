<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;

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
        $hospitals = Hospital::all()->groupBy('region');
        // dd($hospitals['ParePare']);

        return view('pages.home', [
            'hospitals' => $hospitals
        ]);
    }
    
    public function fkrtl()
    {
        $claims = $this->getClaims('FKRTL');

        return view('pages.fkrtl', [
            'claims' => $claims
        ]);
    }

    public function fktp()
    {
        $claims = $this->getClaims('FKTP');

        return view('pages.fktp', [
            'claims' => $claims
        ]);
    }

    private function getClaims($level)
    {
        return Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', $level)
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')
            ->orderBy('claims.updated_at', 'desc')
            ->get();
    }
}

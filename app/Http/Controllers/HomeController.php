<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Hospital;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use IntlDateFormatter;

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

    private function numToMonth($month)
    {
        if ($month == 1) {
            return "Januari";
        } else if ($month == 2) {
            return "Februari";
        } else if ($month == 3) {
            return "Maret";
        } else if ($month == 4) {
            return "April";
        } else if ($month == 5) {
            return "Mei";
        } else if ($month == 6) {
            return "Juni";
        } else if ($month == 7) {
            return "Juli";
        } else if ($month == 8) {
            return "Agustus";
        } else if ($month == 9) {
            return "September";
        } else if ($month == 10) {
            return "Oktober";
        } else if ($month == 11) {
            return "November";
        } else if ($month == 12) {
            return "Desember";
        }
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

        $monthNow = Carbon::now()->locale('id')->month;
        $lastMonthName = $this->numToMonth($monthNow - 1);

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
            ->where('claims.month', 'LIKE', '%' . $lastMonthName . '%')
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

        $monthNow = Carbon::now()->locale('id')->month;
        $lastMonthName = $this->numToMonth($monthNow - 1);

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
            ->where('claims.month', 'LIKE', '%' . $lastMonthName . '%')
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

        $monthNow = Carbon::now()->locale('id')->month;
        $lastMonthName = $this->numToMonth($monthNow - 1);

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
            ->where('claims.month', 'LIKE', '%' . $lastMonthName . '%')
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

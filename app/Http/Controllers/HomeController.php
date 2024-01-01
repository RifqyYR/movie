<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Carbon\Carbon;
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
        $claims = Claim::where('status', '!=', 'Pembayaran Telah Dilakukan')->get();

        return view('pages.home', [
            'claims' => $claims
        ]);
    }
}

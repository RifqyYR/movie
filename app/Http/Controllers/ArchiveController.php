<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        return view('pages.archive.archive');
    }

    public function create()
    {
        $hospitals = Hospital::all();
        return view('pages.archive.create-archive', [
            'hospitals' => $hospitals
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
    }
}

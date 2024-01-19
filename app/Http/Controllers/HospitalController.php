<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class HospitalController extends Controller
{
    public function index()
    {
        $hospital = Hospital::all();
        return view('pages.faskes.faskes', [
            'hospitals' => $hospital,
        ]);
    }

    public function delete(String $id)
    {
        $hospital = Hospital::find($id);
        if ($hospital) {
            $hospital->delete();
            return redirect()->route('faskes')->with('success', 'Berhasil menghapus faskes');
        }
        return redirect()->back()->with('error', 'Gagal hapus user');
    }

    public function create()
    {
        return view('pages.faskes.create-faskes');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::transaction(function () use ($data) {
                Hospital::create([
                    'uuid' => Uuid::uuid7(),
                    'name' => $data['nama_faskes'],
                    'code' => $data['kode_faskes'],
                    'region' => $data['wilayah'],
                    'level' => $data['tingkat'],
                ]);
            });

            return redirect()->route('faskes')->with('success', 'Berhasil menambahkan faskes');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan faskes: ' . $e->getMessage());
        }
    }
}

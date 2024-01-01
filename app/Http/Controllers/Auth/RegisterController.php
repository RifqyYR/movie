<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute yang diinput sudah terdaftar',
            'min' => ':attribute minimal 8 karakter',
        ];

        $validator = $this->validate(
            $request,
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string',
                'role' => 'required'
            ],
            $messages
        );

        if ($validator) {
            if ($request->password == $request->password_confirmation) {
                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'email_verified_at' => now(),
                ]);

                return redirect()->route('home')->with('success', 'Berhasil menambahkan user.');
            }
            
            return redirect()->back()->with('error', 'Password dan Confirm Password tidak sesuai');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan user.');
        }
    }
}

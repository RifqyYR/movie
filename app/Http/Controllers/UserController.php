<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view(
            'pages.user.user',
            [
                'users' => $users,
            ],
        );
    }

    public function edit(String $id)
    {
        $user = User::find($id);

        return view('pages.user.edit-user', [
            'user' => $user,
        ]);
    }

    public function editProcess(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'role' => 'required',
        ], $messages);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);


        if ($user) {
            return redirect()->route('user')->with('success', 'Berhasil update user');
        }
        return redirect()->back()->with('error', 'Gagal update user');
    }

    public function delete(String $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user')->with('success', 'Berhasil menghapus user');
        }
        return redirect()->back()->with('error', 'Gagal hapus user');
    }

    public function changePassword(String $id)
    {
        $user = User::find($id);

        return view('pages.user.change-password', [
            'user' => $user,
        ]);
    }

    public function changePasswordProcess(User $user, Request $request)
    {
        $user->update([
            'password' => $request->password,
        ]);

        if ($user) {
            return redirect()->route('home')->with('success', 'Berhasil ubah password');
        }
        return redirect()->back()->with('error', 'Gagal ubah password');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\User;
use App\Notifications\ExampleNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function callback(Request $request)
    {
        $authUser = Auth::user();
        $telegramChatId = $request->input('id');
        $authUser->update(['telegram_chat_id' => $telegramChatId]);

        return redirect()->route('home');
    }

    public function message()
    {
        $users = User::where('role', 'VERIFICATOR')->get();

        foreach ($users as $user) {
            $claims = Claim::where('completion_limit_date', Carbon::tomorrow())
                ->get();

            if ($claims->count() > 0) {
                $message = "Halo, {$user->name}! Besok ada " . $claims->count() . " claim yang harus diverifikasi. Silahkan cek di aplikasi.";
                $user->notify(new ExampleNotification($message));
            }
        }

        return redirect()->back();
    }
}

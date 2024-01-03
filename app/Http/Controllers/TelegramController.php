<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ExampleNotification;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function callback(Request $request)
    {
        $authUser = Auth::user();
        // if (!$user = $telegramLoginAuth->validate($request)) {
        //     return 'Telegram Response is not valid';
        // }
        $telegramChatId = $request->input('id');
        $authUser->update(['telegram_chat_id' => $telegramChatId]);
        return redirect()->route('home');
    }

    public function message(Request $request)
    {
        auth()->user()->notify(new ExampleNotification($request->message));

        return redirect()->back();
    }
}

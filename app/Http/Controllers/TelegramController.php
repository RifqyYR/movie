<?php

namespace App\Http\Controllers;

use App\Notifications\ExampleNotification;
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

    public function message(Request $request)
    {
        auth()->user()->notify(new ExampleNotification($request->message));

        return redirect()->back();
    }
}

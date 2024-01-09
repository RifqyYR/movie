<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\User;
use App\Notifications\ExampleNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NotificationChannels\Telegram\TelegramMessage;

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
        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', 'FKRTL')
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')
            ->orderBy('claims.updated_at', 'desc')
            ->get();

        $now = Carbon::now();
        $endClaim = array();
        $diffStatus = [Claim::STATUS_BA_KELENGKAPAN_BERKAS, Claim::STATUS_BA_HASIL_VERIFIKASI, Claim::STATUS_TELAH_REGISTER_BOA];
        foreach ($claims as $item) {
            $your_date = Carbon::parse($item->created_date);
            $completion_limit_date = Carbon::parse($item->file_completeness);

            $datediff = $your_date->diffInDays($now);
            $dateDiffFinance = $completion_limit_date->diffInDays($now);

            if ($item->status == Claim::STATUS_BA_SERAH_TERIMA) {
                if ($datediff + 1 >= 7 && $datediff + 1 <= 10) {
                    array_push($endClaim, $item);
                }
            } elseif (in_array($item->status, $diffStatus)) {
                if ($dateDiffFinance + 1 >= 7 && $dateDiffFinance + 1 <= 10) {
                    array_push($endClaim, $item);
                }
            } else {
                if ($dateDiffFinance + 1 >= 13) {
                    array_push($endClaim, $item);
                }
            }
        }

        $message = "Daftar klaim FKRTL yang akan berakhir:\n";
        $numItems = count($endClaim);
        $i = 0;
        foreach ($endClaim as $item) {
            if ($claims->count() > 0) {
                $your_date = Carbon::parse($item->created_date);
                $completion_limit_date = Carbon::parse($item->file_completeness);

                $datediff = $your_date->diffInDays($now);
                $dateDiffFinance = $completion_limit_date->diffInDays($now);

                $message .= "Nama Faskes: $item->hospital_name\nKlaim: $item->claim_type $item->month\nStatus saat ini:" . " *$item->status" . " hari ke-" . ($item->status == Claim::STATUS_BA_SERAH_TERIMA ? $datediff + 1 : $dateDiffFinance + 1) . "* " . (++$i === $numItems ? "\n\n\n\n" : "\n\n");
            }
        }
        $message .= "Silahkan lakukan pengecekan pada aplikasi Movie: https://movie.pmukcpare2.com";

        $user = User::first();
        foreach ($user as $item) {
            $item->notify(new ExampleNotification($message));
        }
    }

    public function message_fktp()
    {
        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('status', '!=', 'Pembayaran Telah Dilakukan')
            ->where('hospitals.level', 'FKTP')
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')
            ->orderBy('claims.updated_at', 'desc')
            ->get();

        $now = Carbon::now();
        $endClaim = array();
        $diffStatus = [Claim::STATUS_BA_KELENGKAPAN_BERKAS, Claim::STATUS_BA_HASIL_VERIFIKASI, Claim::STATUS_TELAH_REGISTER_BOA];
        foreach ($claims as $item) {
            $your_date = Carbon::parse($item->created_date);
            $completion_limit_date = Carbon::parse($item->file_completeness);

            $datediff = $your_date->diffInWeekdays($now);
            $dateDiffFinance = $completion_limit_date->diffInWeekdays($now);

            $holidays = config('app.holidays');

            foreach ($holidays as $holiday) {
                $holidayDate = Carbon::parse($holiday);
                if ($holidayDate->between($your_date, $now)) {
                    $datediff--;
                }
                if ($holidayDate->between($completion_limit_date, $now)) {
                    $dateDiffFinance--;
                }
            }

            if ($item->status == Claim::STATUS_BA_SERAH_TERIMA) {
                if ($datediff + 1 >= 7 && $datediff + 1 <= 10) {
                    array_push($endClaim, $item);
                }
            } elseif (in_array($item->status, $diffStatus)) {
                if ($dateDiffFinance + 1 >= 7 && $dateDiffFinance + 1 <= 10) {
                    array_push($endClaim, $item);
                }
            } else {
                if ($dateDiffFinance + 1 >= 13) {
                    array_push($endClaim, $item);
                }
            }
        }

        $message = "Daftar klaim FKTP yang akan berakhir:\n";
        $numItems = count($endClaim);
        $i = 0;
        foreach ($endClaim as $item) {
            if ($claims->count() > 0) {
                $your_date = Carbon::parse($item->created_date);
                $completion_limit_date = Carbon::parse($item->file_completeness);

                $datediff = $your_date->diffInWeekdays($now);
                $dateDiffFinance = $completion_limit_date->diffInWeekdays($now);

                $holidays = config('app.holidays');

                foreach ($holidays as $holiday) {
                    $holidayDate = Carbon::parse($holiday);
                    if ($holidayDate->between($your_date, $now)) {
                        $datediff--;
                    }
                    if ($holidayDate->between($completion_limit_date, $now)) {
                        $dateDiffFinance--;
                    }
                }

                $message .= "Nama Faskes: $item->hospital_name\nKlaim: $item->claim_type $item->month\nStatus saat ini:" . " *$item->status" . " hari ke-" . ($item->status == Claim::STATUS_BA_SERAH_TERIMA ? $datediff + 1 : $dateDiffFinance + 1) . "* " . (++$i === $numItems ? "\n\n\n\n" : "\n\n");
            }
        }
        $message .= "Silahkan lakukan pengecekan pada aplikasi Movie: https://movie.pmukcpare2.com";

        $user = User::first();
        foreach ($user as $item) {
            $item->notify(new ExampleNotification($message));
        }
    }
}

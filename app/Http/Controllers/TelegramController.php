<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\User;
use App\Notifications\ExampleNotification;
use Carbon\Carbon;

class TelegramController extends Controller
{
    // public function callback(Request $request)
    // {
    //     $authUser = Auth::user();
    //     $telegramChatId = $request->input('id');
    //     $authUser->update(['telegram_chat_id' => $telegramChatId]);

    //     return redirect()->route('home');
    // }

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
        $endClaim = [];
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

        $message = "Daftar klaim FKRTL yang akan jatuh tempo:\n\n=============================\n";
        $numItems = count($endClaim);
        $i = 0;
        foreach ($endClaim as $item) {
            if ($claims->count() > 0) {
                $your_date = Carbon::parse($item->created_date);
                $completion_limit_date = Carbon::parse($item->file_completeness);

                $datediff = $your_date->diffInDays($now);
                $dateDiffFinance = $completion_limit_date->diffInDays($now);

                $message .= "Nama Faskes: $item->hospital_name\nKlaim: $item->claim_type $item->month\nStatus saat ini:" . " *$item->status" . ' hari ke-' . ($item->status == Claim::STATUS_BA_SERAH_TERIMA ? $datediff + 1 : $dateDiffFinance + 1) . '* ' . (++$i === $numItems ? "\n=============================\n\n\n\n" : "\n=============================\n");
            }
        }
        $message .= 'Silahkan lakukan pengecekan pada aplikasi Movie: https://movie.pmukcpare2.com';

        if (count($endClaim) != 0) {
            $user = User::first();
            $groupIds = ['-4145586916', '-4192360145'];

            foreach ($groupIds as $groupId) {
                $user->notify(new ExampleNotification($message, $groupId));
            }
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
        $endClaim = [];
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
                if ($datediff + 1 >= 2) {
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

        $message = "Daftar klaim FKTP yang akan jatuh tempo:\n\n=============================\n";
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

                $message .= "Nama Faskes: $item->hospital_name\nKlaim: $item->claim_type $item->month\nStatus saat ini:" . " *$item->status" . ' hari ke-' . ($item->status == Claim::STATUS_BA_SERAH_TERIMA ? $datediff + 1 : $dateDiffFinance + 1) . '* ' . (++$i === $numItems ? "\n=============================\n\n\n\n" : "\n=============================\n");
            }
        }
        $message .= 'Silahkan lakukan pengecekan pada aplikasi Movie: https://movie.pmukcpare2.com';

        if (count($endClaim) != 0) {
            $user = User::first();
            $groupIds = ['-4145586916', '-4192360145'];

            foreach ($groupIds as $groupId) {
                $user->notify(new ExampleNotification($message, $groupId));
            }
        }
    }

    public function message_cashier()
    {
        $claims = Claim::with('hospital')
            ->join('hospitals', 'claims.hospital_uuid', '=', 'hospitals.uuid')
            ->where('status', 'Pembayaran Telah Dilakukan')
            ->where('ba_date', today())
            ->select('claims.*', 'hospitals.uuid as hospital_uuid', 'hospitals.level')
            ->get()
            ->groupBy('level');

        $message = "Daftar klaim yang telah dibayarkan:\n\n=============================\n";
        foreach ($claims as $level => $claimsGroup) {
            $message .= 'Jenis: ' . $level . "\n";
            foreach ($claimsGroup as $claim) {
                $message .= $claim->hospital->name . "\n";
            }
            $message .= "=============================\n";
        }
        $message .= 'Untuk detailnya dapat dilakukan pengecekan pada email dan rekening bank faskes masing-masing';

        if (count($claims) != 0) {
            $user = User::first();
            $user->notify(new ExampleNotification($message, '-1002094693959'));
        }
    }
}

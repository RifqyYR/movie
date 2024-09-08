<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ArchiveNumberGenerator
{
    public static function generateUniqueArchiveNumber()
    {
        return DB::transaction(function () {
            // Lock the table to prevent concurrent access
            DB::table('archives')->lockForUpdate()->get();

            // Get the latest archive number
            $latestArchive = DB::table('archives')
                ->where('dos_number', 'like', 'P-%')
                ->orderByRaw('CAST(SUBSTRING(dos_number, 3) AS UNSIGNED) DESC')
                ->first();

            if ($latestArchive) {
                // Extract the numeric part and increment
                $latestNumber = intval(substr($latestArchive->dos_number, 2));
                $newNumber = $latestNumber + 1;
            } else {
                // If no archives, start with 1
                $newNumber = 1;
            }

            // Format the new archive number
            if ($newNumber < 100) {
                $newArchiveNumber = sprintf("P-%03d", $newNumber);
            } else {
                $newArchiveNumber = sprintf("P-%d", $newNumber);
            }

            return $newArchiveNumber;
        }, 5); // Retry up to 5 times in case of deadlock
    }
}

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
                ->orderByDesc('dos_number')
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
            $newArchiveNumber = sprintf("P-%03d", $newNumber);

            return $newArchiveNumber;
        }, 5); // Retry up to 5 times in case of deadlock
    }
}

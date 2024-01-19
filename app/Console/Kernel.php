<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message();
        })->everyMinute()->timezone('Asia/Singapore');
        
        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message_fktp();
        })->everyMinute()->timezone('Asia/Singapore');

        $schedule->call(function() {
            app()->make('App\Http\Controllers\ArchiveController')->checkInactiveArchive();
        })->everyFiveSeconds()->timezone('Asia/Singapore');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

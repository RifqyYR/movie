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
        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message();
        })->dailyAt('07:30')->timezone('Asia/Singapore');
        
        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message_fktp();
        })->dailyAt('07:30')->timezone('Asia/Singapore');
        
        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message_cashier();
        })->dailyAt('16:30')->timezone('Asia/Singapore');

        $schedule->call(function() {
            app()->make('App\Http\Controllers\ArchiveController')->checkInactiveArchive();
        })->everyMinute()->timezone('Asia/Singapore');

        $schedule->call(function() {
            app()->make('App\Http\Controllers\ClaimController')->deleteClaims();
        })->everyMinute()->timezone('Asia/Singapore');

        $schedule->call(function() {
            app()->make('App\Http\Controllers\TelegramController')->message_notes();
        })->dailyAt('16:00')->timezone('Asia/Singapore');

        $schedule->call(function() {
            app()->make('App\Http\Controllers\NotesController')->deleteAllNotes();
        })->dailyAt('18:00')->timezone('Asia/Singapore');
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

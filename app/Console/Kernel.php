<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $updateData = function () {
            // Perform the update operation here
            // For example, you can use the Eloquent ORM to update a model:
            \App\Models\SeminarKP::where('jam_seminar', '>', now())
                ->update(['stts_seminar' => 'selesai']);
        };

        // Schedule the closure to run every hour
        $schedule->call($updateData)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console;

use App\Jobs\GetDollarPrice;
use App\Jobs\SearchSuspendedPlan;
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

        // $schedule->job(new GetDollarPrice)->everyMinute(); //hourly ***

        $schedule->job(new SearchSuspendedPlan)->everyThirtySeconds(); //hourly ***

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

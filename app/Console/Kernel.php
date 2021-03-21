<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import-domains')
            ->dailyAt('04:00')
            ->timezone('Europe/Vienna');

        $schedule->command('daily-visits')
            ->dailyAt('00:00')
            ->timezone('Europe/Vienna');

        $schedule->command('add-daily-visits-to-adomino-com')
            ->dailyAt('00:15')
            ->timezone('Europe/Vienna');

        $schedule->command('add-total-to-visits-per-day')
            ->dailyAt('00:30')
            ->timezone('Europe/Vienna');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

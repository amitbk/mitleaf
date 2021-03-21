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
        $schedule->command('posts:schedule')
                  ->hourly()
                  ->runInBackground();

        $schedule->command('posts:generate')
                  ->hourly()
                  ->runInBackground();

        $schedule->command('posts:publish')
                  ->hourly()
                  ->runInBackground();

        $schedule->command('send:order_end_reminder 7')
                  ->hourly()
                  ->runInBackground();

        $schedule->command('send:order_end_reminder 2')
                  ->hourly()
                  ->runInBackground();

        $schedule->command('send:order_end_reminder 0')
                  ->hourly()
                  ->runInBackground();
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

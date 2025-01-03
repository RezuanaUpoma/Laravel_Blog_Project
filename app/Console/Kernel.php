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
        $schedule->command('optimize:clear')->daily();
        $schedule->command('config:cache')->daily();
        $schedule->command('cache:clear')->daily();
        
        $schedule->command('view:clear')->hourly();
        $schedule->command('view:cache')->hourly();
        $schedule->command('auth:clear-resets')->weekly()->mondays()->timezone('Asia/Kolkata')->between('00:00', '1:00');
        
        // $schedule->command('queue:work')->withoutOverlapping()->runInBackground();
        $schedule->command('queue:flush')->weekly()->mondays()->timezone('Asia/Kolkata')->between('00:00', '1:00');


        // $schedule->command('backup:clean')->dailyAt('01:00')->timezone('Asia/Kolkata');
        // $schedule->command('backup:run')->dailyAt('01:00')->timezone('Asia/Kolkata');
        $schedule->command('backup:clean')->daily()->timezone('Asia/Kolkata')->between('00:00', '1:00');;
        $schedule->command('backup:run')->daily()->timezone('Asia/Kolkata')->between('00:00', '1:00');
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

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
         Commands\CheckSites::class,
         Commands\CheckByUrl::class,
         Commands\CheckAllSites::class,
         Commands\ResetFailedSites::class,
         Commands\SyncEmailsWithLDAP::class
     ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Add a checking job every minute
        $schedule->call(function () {
            dispatch(new \App\Jobs\CheckSites);
        })->everyMinute();

        //Sync emails with LDAP daily
        $schedule->command('check:sync-emails')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

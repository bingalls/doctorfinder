<?php

namespace App\Console;

use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DoctorSeeder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
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
        // $schedule->command('activitylog:clean')->daily();
        $schedule->call(function () {
            $dbSeed = new DatabaseSeeder();
            $dbSeed->call(AnnouncementSeeder::class);
            $dbSeed->call(DoctorSeeder::class);
        })->yearly();   // https://laravel.com/docs/8.x/scheduling#schedule-frequency-options
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

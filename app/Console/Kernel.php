<?php

namespace App\Console;

use App\Console\Commands\CreateOrAssignAdmin;
use App\Console\Commands\SettupApp;
use App\Console\Commands\UsersSearch;
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
        InsertDemoContents::class,
        UpdateCategoryNameInPosts::class,
        SettupApp::class,
        UsersSearch::class,
        CreateOrAssignAdmin::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
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

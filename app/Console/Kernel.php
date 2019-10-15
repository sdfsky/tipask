<?php

namespace App\Console;

use App\Console\Commands\SyncAliVideo;
use App\Console\Commands\VideoToCourse;
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
        SyncAliVideo::class,
        VideoToCourse::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*每分钟更新一下视频信息*/
        $schedule->command('sync:video')->everyMinute();

        /*每天上午10点和下午3点自动采纳回答*/
        $schedule->command('adoptAnswer')->twiceDaily(10, 15);

        /*每天4点备份备份一次数据库*/
        $schedule->command("backup:run --only-db")->dailyAt('4:00');

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

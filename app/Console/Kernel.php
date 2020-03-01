<?php

namespace App\Console;

use App\Configration;
use App\Jobs\listMovies;
use Carbon\Carbon;
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

            $schedule->job(new listMovies())->everyMinute()->when(function (){
                return $this->queue_run_validation();
            });

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
    private function queue_run_validation(){
        if (Configration::getConfigValue('last_queue_run') == 0){
            return true;
        }else{
            $last_run = new Carbon(Configration::getConfigValue('last_queue_run'));
            $interval = Configration::getConfigValue('interval_timer');
            $now = Carbon::now();
            $diff = $now->diff($last_run)->days;
            if($interval == 0 && $diff >= 1){
                return true;
            }elseif($interval > 0 && $diff >= $interval){
                return true;
            }else{
                return false;
            }
        }
    }
}

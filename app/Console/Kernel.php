<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

use App\Models\Economy;
use App\Models\EconomyHistory;
use App\Models\ServerPlayerHistory;
use App\Models\Account;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $economyData = Economy::all();

            foreach($economyData as $item) {
                $newEconomyHistory = new EconomyHistory();
                $newEconomyHistory->economyId = $item->economyId;
                $newEconomyHistory->value = $item->value;
                $newEconomyHistory->created_at = Carbon::now();
                $newEconomyHistory->save();
            }

        })->dailyAt('22:00');

        $schedule->call(function () {
            $onlinePlayers = Account::where('Online', 1)->count();

            $playerHistory = new ServerPlayerHistory();
            $playerHistory->amount = $onlinePlayers;
            $playerHistory->created_at = Carbon::now();
            $playerHistory->save();

        })->hourly();

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

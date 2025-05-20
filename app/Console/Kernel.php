<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * Les commandes Artisan personnalisées de l’application.
     */
    protected $commands = [
        \App\Console\Commands\GenerateModuleData::class, // Enregistre la commande
    ];

    /**
     * Définit le planning des tâches.
     */
    protected function schedule(Schedule $schedule) {
        // Planifie la commande "modules:generate" toutes les minutes
        $schedule->command('modules:generate');
    }

    /**
     * Enregistre les commandes pour l’application.
     */
    protected function commands() {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

}
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
        \App\Console\Commands\EmailRecordatorioEvento::class,
        \App\Console\Commands\FacturasEvento::class,
        \App\Console\Commands\FacturasEventoNuevoInquilino::class,
        \App\Console\Commands\RecordatorioAdminFacturasPorPagar::class,
        \App\Console\Commands\RecordatorioAdminContratos::class,
        \App\Console\Commands\FacturasCreacionInquilinos::class,
        \App\Console\Commands\RecordatorioAdminRenovacionContratos::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('email:facturasevento')
                 ->dailyAt('06:00');
        //$schedule->command('email:facturasevento')
        //         ->monthlyAt('06:00');
        $schedule->command('email:recordatorioadmin')
                 ->dailyAt('06:00');
        //$schedule->command('email:recordatorioadminrenovacioncontratos')
        //         ->dailyAt('10:51');
        //$schedule->command('email:recordatorioadmincontratos')
        //         ->dailyAt('14:16');
        $schedule->command('email:facturasinquilino')
                 ->dailyAt('05:55');
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

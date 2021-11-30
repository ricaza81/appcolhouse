<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\PropertiesFacturas;
use Carbon\Carbon;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

class RecordatorioAdminRenovacionContratos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:recordatorioadminrenovacioncontratos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualización de Canon Arrendamiento';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
                   
         $usuarios = User::where('estado',1)->where('deleted_at','=',NULL)->where('role_id','!=',1)->get();
           // $email_tenant = 'ricaza81@gmail.com';
                $asunto = 'Actualización de Canon Arrendamiento (informe automático)';
             
           foreach($usuarios as $usuario){
              
               $fecha_inicio=$usuario->fecha_inicio_contrato;
               $fecha_start=Carbon::parse($fecha_inicio);
               //$fecha_end=date('Y-m-d');
               //$fecha_end=Carbon::parse($fecha);
               $fecha_end=Carbon::now();
               $difference = $fecha_start->diffInDays($fecha_end);

               // if($difference >= 350) {

               $data = array(
                            'difference' => $difference,
                            'usuarios' => $usuarios,
                        );

           //}
      }
                Mail::send('correo.plantilla_renovacion_contratos_recordatorio', $data, function ($message) use ($asunto,$usuarios,$difference) {
                    //$message->from('crm@aplicatics.com', 'CRM Aplicatics');
                    $message->to('ricaza81@gmail.com')
                            ->cc('laurazambranoduran.abogada@gmail.com')
                            ->subject($asunto);  
                    //$message->to($destinatario)->subject($asunto);  
                                                                 });
            
            //                }
          
       
       // }

    	//Mostrando el resultado
    	$this->info('Recordatorio enviado!');
    }

}

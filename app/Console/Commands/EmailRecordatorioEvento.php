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

class EmailRecordatorioEvento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:evento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recordatorio Factura';

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
        $usuarios = User::all();
        //$facturas = PropertiesFacturas::where('id_estado','1')->get();

       // $idempresa=$usuario->idEmpresa;
       // $usuarios=User::where('idEmpresa','=',$idempresa);

        foreach ($usuarios as $usuario) {
            if(sizeof($usuario->facturas)) {

              //  $id_factura=$factura->id;
              //  $email_tenant=$factura->tenant->email;
                $asunto = 'Recordatorio de Factura Por Pagar';
                $facturas = PropertiesFacturas::where('id_estado','1')->where('id_tenant',$usuario->id)->get();
                
            
           foreach($facturas as $factura){
               $email_tenant = 'ricaza81@gmail.com';
              
               $fecha=date('Y-m-d');

                $data = array(
                            'nombres' => $factura->tenant->name,
                            'email_tenant' => $factura->tenant->email,
                            'id_factura' => $factura->id,
                            'fecha' =>   $fecha,
                            'valor' =>   $factura->valor_neto,
                            'facturas' => $facturas,
                        );

              //   }
            
                Mail::send('correo.plantilla_evento_recordatorio', $data, function ($message) use ($asunto,$fecha,$facturas) {
                            //$message->from('crm@aplicatics.com', 'CRM Aplicatics');
                    $message->to('ricaza81@gmail.com')
                            //->cc('ricaza81@gmail.com')
                            ->cc('laurazambranoduran.abogada@gmail.com')
                            ->subject($asunto);  
                    //$message->to($destinatario)->subject($asunto);  
                                                                 });
            }
           
            }
        }
        

    	//Mostrando el resultado
    	$this->info('Recordatorio enviado!');
    }

}

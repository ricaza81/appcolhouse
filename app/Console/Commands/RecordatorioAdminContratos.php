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

class RecordatorioAdminContratos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:recordatorioadmincontratos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisión de contratos';

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
                   
         $usuarios = User::where('duracion_meses',NULL)->where('deleted_at','=',NULL)->where('role_id','!=',1)->get();
           // $email_tenant = 'ricaza81@gmail.com';
                $asunto = 'Revisión de contratos (informe automático)';
          // foreach($facturas as $factura){
              
              if(sizeof($usuarios)) {
               $fecha=date('Y-m-d');
                $data = array(
                          //  'nombres' => $factura->tenant->name,
                          //  'email_tenant' => $factura->tenant->email,
                          //  'id_factura' => $factura->id,
                          //  'fecha' =>   $fecha,
                          //  'valor' =>   $factura->valor_neto,
                            'usuarios' => $usuarios,
                        );


                Mail::send('correo.plantilla_contratos_recordatorio', $data, function ($message) use ($asunto,$fecha,$usuarios) {
                    //$message->from('crm@aplicatics.com', 'CRM Aplicatics');
                    $message->to('ricaza81@gmail.com')
                            ->cc('laurazambranoduran.abogada@gmail.com')
                            ->subject($asunto);  
                    //$message->to($destinatario)->subject($asunto);  
                                                                 });
            
                //            }
          
       }
        

    	//Mostrando el resultado
    	$this->info('Recordatorio enviado!');
    }

}

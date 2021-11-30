<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\PropertySub;
use App\PropertiesFacturas;
use App\PropertiesPagos;
use Carbon\Carbon;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;

class FacturasCreacionInquilinos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:facturasinquilino';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creación de Factura';

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
        $unidades = PropertySub::all();
        $fecha=date('Y-m-d');
        //$asunto = 'Notificación Creación de Factura';
        $mes=date('m');
        for ($i=$mes;$i<=$mes;$i++) {
             $fecha=date('Y-m-d');
             $fecha2 = '2021-'.$i.'-01';
          if($fecha==$fecha2)           {
        foreach ($unidades as $unidad)    {
             if ($unidad->cuenta_inquilinos2($unidad->id) > 0) {
                $factura=new PropertiesFacturas;
                $factura->id_property = $unidad->id_property;
                $factura->id_property_sub = $unidad->id;
                $factura->id_tenant = $unidad->id_tenant;
                $factura->id_estado = 1;
                $factura->fuente = 'cronjob';
                $factura->fecha_inicio = '2021-'.$i.'-01';
                $factura->fecha_corte = '2021-'.$i.'-01';
                $factura->valor = $unidad->renta;
                $factura->adicionales = 0;
                $factura->deducciones = 0;                
                $factura->valor_neto = $unidad->renta;
                $factura->save();

                 $factura = $factura;
                $facturas = PropertiesPagos::where('id_factura',$factura->id)->get();
                $id_tenant=$factura->tenant->id;
                $tenant=User::findOrFail($id_tenant);
                $fecha_fin_contrato=$tenant->fecha_fin_contrato;
                $fecha_limite_renovacion1= strtotime ( '-90 day' , strtotime ( $fecha_fin_contrato));
                $fecha_limite_renovacion = date ( 'Y-m-d' , $fecha_limite_renovacion1 );
                 $facturas=PropertiesFacturas::where('fecha_inicio','=','2021-'.$mes.'-01')->where('fuente','=','cronjob')->get();
                $pdf = \PDF::loadView('admin.properties_facturas.facturapdf',compact('factura','facturas','fecha_fin_contrato','fecha_limite_renovacion'));
                 $asunto='Tu factura ha sido generada';
        $mes=date('m');
       
          $facturas=PropertiesFacturas::where('fecha_inicio','=','2021-'.$mes.'-01')->where('fuente','=','cronjob')->get();
        $total_facturas=count($facturas);
         $data = array(
                        'facturas' => $facturas,
                        'total_facturas' => $total_facturas,
                        'factura' => $factura,
                        'fecha_limite_renovacion' => $fecha_limite_renovacion,
                        );
         
         $pdf = \PDF::loadView('admin.properties_facturas.facturapdf',compact('factura','facturas','fecha_fin_contrato','fecha_limite_renovacion'));
      

         Mail::send('correo.plantilla_factura', $data, function ($message) use ($asunto,$pdf,$factura,$mes) {
                    //$message->from('crm@aplicatics.com', 'CRM Aplicatics');
                    $message->to('ricaza81@gmail.com')
                            ->cc('laurazambranoduran.abogada@gmail.com')
                            ->subject($asunto) 
                    ->attachData($pdf->output(), "FacturaColHouse-#$factura->id-mes-$mes.pdf");
                                                                 });

               
    
                                                                }
                                         }
                                       }
                                    }

       

       
            $this->info('Facturas creadas automaticamente');
        }
    }
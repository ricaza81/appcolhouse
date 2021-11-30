<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\PropertySub;
use App\PropertiesFacturas;
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

class FacturasEventoNuevoInquilino extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:facturaseventonuevoinquilino';

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
    /*public function __construct()
    {
        parent::__construct();
        Carbon::setLocale('es');
    }*/

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
        //$facturas = PropertiesFacturas::where('id_estado','1')->get();

       // $idempresa=$usuario->idEmpresa;
       // $usuarios=User::where('idEmpresa','=',$idempresa);
        //$fecha=date('Y-m-d');

       
        //$fecha = Carbon::now();
       
        //$fecha2 = '2021-08-02';
        //$fecha2 = '2021-0'.$mes.'-31';
        //$fecha2 = date('Y-m-d');
        $asunto = 'Notificación Creación de Factura';
        //$mes=1;
        //$mes_actual=date('m');
        
        //$mes_nuevo=$mes_actual + 1;
        //$mes=8;


         //for ($i=$mes_nuevo;$i<=$mes_nuevo;$i++) {

         //   $mes_actual=date('m');
             //$fecha2 = '2021-08-02';
         //    $fecha2 = '2021-'.$i.'-03';
             
          //   $fecha2 = '2021-.$mes.-2';

          //if($fecha==$fecha2) {
        foreach ($unidades as $unidad) {

           
                //$fecha_creacion_usuario=$unidad->inquilino($unidad->id)->diffInDays(Carbon::now());
                //$fecha_creacion_usuario2=Carbon::$fecha_creacion_usuario;
                //$mes_creacion_usuario=date($fecha_creacion_usuario('m'));
                //$mes_actual=date('m');
                //$fecha=date('Y-m-d')->toDateTimeString();
                //$fecha2=date('Y-m-d')->toDateTimeString();
                //$fecha = Carbon::now();
                //$fecha2 = Carbon::now();
                //$fecha_contrato=$unidad->tenant->fecha_inicio_contrato;

                $fecha_inicio=$unidad->fecha_inicio_inquilino($unidad->id);
                $fecha_start=Carbon::parse($fecha_inicio);
                $fecha_fin= $unidad->fecha_fin_inquilino($unidad->id);
                $fecha_end=Carbon::now();

                $difference = $fecha_start->diffInDays($fecha_end);

                if(  $difference   <= 6) {
                if (($unidad->cuenta_facturas_tenant($unidad->id)) < 1) {
                if ($unidad->cuenta_inquilinos2($unidad->id) > 0) {
               

                $mes=date('m');
                $factura=new PropertiesFacturas;
                $factura->id_property = $unidad->propiedad->id;
                $factura->id_property_sub = $unidad->id;
                $factura->id_tenant = $unidad->id_tenant($unidad->id);
                $factura->id_estado = 1;
                $factura->fecha_inicio = '2021-'.$mes.'-01';
                $factura->fecha_corte = '2021-'.$mes.'-01';
                $factura->valor_neto = $unidad->renta;
                $factura->save();

                   }
                }
            }
           }
            $this->info('Facturas creadas automaticamente');
        }
    }
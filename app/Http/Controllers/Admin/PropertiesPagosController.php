<?php

namespace App\Http\Controllers\Admin;

use App\PropertiesFacturas;
use App\PropertiesPagos;
use App\Property;
use App\PropertySub;
use App\Documents;
use App\User;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertiesPagoRequest;
use App\Http\Requests\Admin\UpdatePropertiesPagoRequest;
//use App\Http\Requests\Admin\UpdatePropertiesFacturasRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;
use DB;

class PropertiesPagosController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Pagos.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index()
    //{
     /*   if (! Gate::allows('properties_pagos_access')) {
            return abort(401);
        }*/

     /*   if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_pagos_delete')) {
                return abort(401);
            }
            $facturas = PropertiesFacturas::onlyTrashed()->get();
            //$facturas = PropertiesPagos::all();
        } else {
            //$facturas = PropertiesFacturas::all()->orderBy('id_estado','DESC')->get();
            $facturas = PropertiesFacturas::where('deleted_at',NULL)->orderBy('id_estado','ASC')->get();
        }

        return view('admin.properties_pagos.index', compact('facturas'));
    }*/

    public function index()
    {
     /*   if (! Gate::allows('properties_pagos_access')) {
            return abort(401);
        }*/

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_pagos_delete')) {
                return abort(401);
            }
            $inquilinos = User::where('role_id','!=',1)->onlyTrashed()->get();
            //$facturas = PropertiesPagos::all();
        } else {
            //$facturas = PropertiesFacturas::all()->orderBy('id_estado','DESC')->get();
            $inquilinos = User::where('deleted_at',NULL)->where('role_id','!=',1)->orderBy('name','ASC')->get();
        }

        return view('admin.properties_pagos.index', compact('inquilinos'));
    }

      public function facturas_consulta($id)
    {
        if (! Gate::allows('properties_pagos_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_pagos_delete')) {
                return abort(401);
            }
            //$facturas = PropertiesFacturas::where('id_property_sub',$id)::onlyTrashed()->get();
            $facturas = PropertiesFacturas::where('id_property_sub',$id)->get();
        } else {
            $facturas = PropertiesFacturas::where('id_property_sub',$id)->get();
        }

        return view('admin.properties_facturas.index', compact('facturas'));
    }

        public function facturas_propiedad_consulta($id)
    {
        if (! Gate::allows('properties_pagos_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_pagos_delete')) {
                return abort(401);
            }
            //$facturas = PropertiesFacturas::where('id_property_sub',$id)::onlyTrashed()->get();
            //$facturas = PropertiesFacturas::where('id_property',$id)->get();
            $facturas = PropertiesFacturas::onlyTrashed()->where('id_property',$id)->get();
            // $pagos = PropertiesPagos::onlyTrashed()->get();
        } else {
            $facturas = PropertiesFacturas::where('id_property',$id)->get();
        }

        return view('admin.properties_facturas.index', compact('facturas'));
    }

        public function facturas_tenant($id)
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            //$facturas = PropertiesFacturas::where('id_property_sub',$id)::onlyTrashed()->get();
            $facturas = PropertiesFacturas::where('id_tenant',$id)->get();
        } else {
            $facturas = PropertiesFacturas::where('id_tenant',$id)->get();
        }

        return view('admin.properties_facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating new Pago.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (! Gate::allows('properties_pagos_create')) {
            return abort(401);
        }

        $properties = PropertiesFacturas::findOrFail($id);//->pluck('name', 'id');

        return view('admin.properties_pagos.create', compact('properties'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  \App\Http\Requests\StorePropertiesPagoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertiesPagoRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        //$document = Document::create($request->all());

        //$data=$request->all();
        //$valor=$data['valor']*1000;
        //$valor = intval(str_replace(".", "", $_POST['valor']));
        //$pago = PropertiesPagos::create($request->all());
        //$pago = PropertiesPagos::create($request->all() + ['valor' => '$valor']);
        
         $pago = PropertiesPagos::create([
            'id_factura'        => $request->id_factura,
            'id_tenant'         => $request->id_tenant,
            'id_property'       => $request->id_property,
            'id_property_sub'   => $request->id_property_sub,
            'valor'             => $request->valor,
            'observaciones'     => $request->observaciones,
            'fecha_pago'        => $request->fecha_pago,
        ]);

        //Actualizar estado factura//
            $data=$request->all();
            $id_factura=$data['id_factura'];
            $valor=$data['valor'];
            $factura = PropertiesFacturas::findOrFail($id_factura);
            $factura_valor=$factura->valor_neto;
            //$saldo_factura=$factura_valor-$valor;
            $saldofactura=$factura_valor-DB::table('properties_pagos')->where('id_factura','=',$factura->id)->sum('valor')+$valor;

           // if ($saldofactura == 0){
            $factura->id_estado = 2;
            $factura->comision = $data['valor']*1000*$data['porc_comision'];
            //}
            $factura->save();
        //Actualizar estado factura//


        $asunto="Gracias por tu pago ColHouse";
        $property=Property::findOrFail($pago->id_property);
     //   $data=$request->all();
        /*$pago = PropertiesPagos::create*/
     /*  ([
            'id_factura'  => $request->factura_id,
            'id_tenant' => $request->id_tenant,
            'id_property' => $request->id_property,
            'id_property_sub' => $request->id_property_sub,
            'valor' => $request->valor,
        ]);*/

        $id_tenant=$factura->tenant->id;
        $tenant=User::findOrFail($id_tenant);
        $fecha_fin_contrato=$tenant->fecha_fin_contrato;
        $fecha_limite_renovacion1= strtotime ( '-90 day' , strtotime ( $fecha_fin_contrato));
        $fecha_limite_renovacion = date ( 'Y-m-d' , $fecha_limite_renovacion1 );

         $data = array(
         'factura'                  => $factura,
         'id_tenant'                => $request->id_tenant,
         'tenant'                   => $tenant,
         'fecha_fin_contrato'       => $fecha_fin_contrato,
         'fecha_limite_renovacion'  => $fecha_limite_renovacion,
        );

         $pdf = \PDF::loadView('admin.properties_pagos.pagopdf',compact('factura','fecha_fin_contrato','fecha_limite_renovacion'));
    

          Mail::send('correo.plantilla_pago', $data, function ($message)
            use ($factura,$fecha_fin_contrato,$fecha_limite_renovacion,$asunto,$pdf){//,$email_usuario) {
        $message->from('ricaza81@gmail.com', 'ColHouse');
        $message->to('ricaza81@gmail.com')
        //->cc('laurazambranoduran.abogada@gmail.com')
        ->subject($asunto)
        ->attachData($pdf->output(), "PagoColHouse.pdf");
        ;});
        //return redirect()->route('admin.properties_facturas.index')

           $documents = \App\Document::where('tenant_id', $id_tenant)->get();
            $notes     = \App\PropertiesFacturas::where('id_tenant', $id_tenant)->get();
            $facturas = \App\PropertiesFacturas::where('id_tenant', $id_tenant)->get();
         

        //return view('admin.properties_facturas.facturas_propiedad_consulta'.'/'.$pago->id_property)
        return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes'))
        ->with('flash','Pago registrado correctamente');
    }


    /**
     * Show the form for editing Pago.
     *s
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('properties_pagos_edit')) {
            return abort(401);
        }

        $properties = Property::get()->pluck('name', 'id');
        $unidades = PropertySub::get()->pluck('nombre', 'id');
        $pago   = PropertiesPagos::findOrFail($id);

        return view('admin.properties_pagos.edit', compact('unidades','pago','properties'));
    }

    /**
     * Update Pago in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesPagosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertiesPagoRequest $request, $id)
    {
       /* if (! Gate::allows('properties_pagos_edit')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);*/
        $pago = PropertiesPagos::findOrFail($id);
        $pago->update($request->all());

        //Actualizar estado y comision factura//
        $data=$request->all();
        $id_factura=$data['id_factura'];
        $valor=$data['valor'];
        $porc_comision=$data['porc_comision'];
        $factura = PropertiesFacturas::findOrFail($id_factura);
        $factura_valor=$factura->valor_neto;
        //$factura_comision=$valor*$porc_comision;
        //$factura_comision=$data['valor']*$data['porc_comision'];
        //$saldo_factura=$factura_valor-$valor;
        $saldofactura=$factura_valor-DB::table('properties_pagos')->where('id_factura','=',$factura->id)->sum('valor')+$valor;

        //if ($saldofactura == 0){
        $factura->id_estado = 2;
        $factura->comision = $data['valor']*$data['porc_comision'];
        //}
        $factura->save();
        //Actualizar estado factura//


           return redirect()->route('admin.properties_facturas.index')
        ->with('flash','Pago actualizado correctamente');
    }


    /**
     * Display Pago.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       /* if (! Gate::allows('properties_pagos_view')) {
            return abort(401);
        }*/

        $pago = PropertiesPagos::findOrFail($id);

        return view('admin.properties_pagos.show', compact('pago'));
    }


    /**
     * Remove Pago from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* if (! Gate::allows('properties_pagos_delete')) {
            return abort(401);
        }*/

        $pago = PropertiesPagos::findOrFail($id);
        $pago->delete();
        //Actualizar estado factura//
        $id_factura=$pago->factura->id;
        $factura = PropertiesFacturas::findOrFail($id_factura);
        $factura->id_estado = 1;
        $factura->comision = 0;
        $factura->save();
        //Actualizar estado factura//

        return redirect()->route('admin.properties_pagos.index');
    }

    /**
     * Delete all selected Pagos at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        /*if (! Gate::allows('property_pagos_delete')) {
            return abort(401);
        }*/

        if ($request->input('ids')) {
            $entries = PropertiesPagos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Pago from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        /*if (! Gate::allows('property_pagos_view')) {
            return abort(401);
        }*/

        $pago = PropertiesPagos::onlyTrashed()->findOrFail($id);
        $pago->restore();

        return redirect()->route('admin.properties_pagos.index');
    }

    /**
     * Permanently delete Document from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
      /*  if (! Gate::allows('property_pagos_delete')) {
            return abort(401);
        }*/

        $pago = PropertiesPagos::onlyTrashed()->findOrFail($id);
        $pago->forceDelete();

        //Actualizar estado factura//
        $id_factura=$pago->factura->id;
        $factura = PropertiesFacturas::findOrFail($id_factura);
        $factura->id_estado = 1;
        $factura->comision = 0;
        $factura->save();
        //Actualizar estado factura//

        return redirect()->route('admin.properties_pagos.index');
    }

     //Generar PDF
    public function imprimirpago($id){
     //$pdf = \PDF::loadView('ejemplo');
     //return $pdf->download('ejemplo.pdf');

     $pago=PropertiesPagos::findOrFail($id);
     $factura = PropertiesFacturas::findOrFail($pago->id_factura);
     $facturas=PropertiesFacturas::where('id_tenant',$factura->id_tenant);
     $factura_valor=$factura->valor_neto;
     $tenant=User::findOrFail($factura->id_tenant);
     $fecha_fin_contrato=$tenant->fecha_fin_contrato;
     $fecha_limite_renovacion1= strtotime ( '-90 day' , strtotime ( $fecha_fin_contrato));
     $fecha_limite_renovacion = date ( 'Y-m-d' , $fecha_limite_renovacion1 );


    /*$data = array(
            'factura'      => $factura,
            'facturas'      => $facturas,
            'id_factura'  =>    $factura->id,
            'id_tenant' =>      $factura->id_tenant,
            'id_property' =>    $factura->id_property,
            'id_property_sub' => $factura->id_property_sub,
            'valor' =>          $factura_valor,);
    */


      $pdf = \PDF::loadView('admin.properties_pagos.pagopdf',compact('factura','facturas','fecha_fin_contrato','fecha_limite_renovacion'));
     return $pdf->download('Pago COL-PAGO-'.$factura->pago_valor->id.'-'.$factura->tenant->name.'-'.$factura->fecha_inicio.'.pdf');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StorePropertiesPropietariosRequest;
use App\Http\Requests\Admin\UpdatePropertiesPropietariosRequest;
use App\Notifications\InvitationSend;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Property;
use App\PropertiesPagos;
use App\PropertySub;
use App\PropertiesFacturas;
use App\PropertiesPropietarios;
use App\PropietariosDeducciones;
use App\PropertiesSeguros;
use App\PropertyType;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Carbon\Carbon;
use DB;

class PropertiesPropietariosController extends Controller
{

 /**
     * Display a listing of Propietarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (! Gate::allows('properties_seguros_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_propietarios_delete')) {
                return abort(401);
            }
            $property=Property::findOrFail($id);
            $seguros = PropertiesPropietarios::onlyTrashed()->where('id_property','=',$id)->get();
            $id_propietario=$property->propietarios2($property->id)->id;
            $deducciones = PropietariosDeducciones::onlyTrashed()->where('id_propietario','=',$id_propietario)->get();
            $total_deducciones=$deducciones->sum('valor');
        } else {
            $property=Property::findOrFail($id);
            $seguros = PropertiesPropietarios::where('id_property','=',$id)->get();
            $id_propietario=$property->propietarios2($property->id)->id;
            $deducciones = PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
            $total_deducciones=$deducciones->sum('valor');
        }

        return view('admin.properties_propietarios.index', compact('property','seguros','deducciones','total_deducciones'));
    }

    public function indextotal()
    {
        if (! Gate::allows('properties_seguros_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_propietarios_delete')) {
                return abort(401);
            }
            $property=Property::all();
            $seguros = PropertiesPropietarios::onlyTrashed()->orderBy('created_at','DESC')->get();
            //$facturas = PropertiesPagos::all();
        } else {
           $property=Property::all();
           $seguros = PropertiesPropietarios::where('deleted_at',NULL)->orderBy('created_at','DESC')->get();
        }

        return view('admin.properties_propietarios.indextotal', compact('property','seguros'));
    }

	   public function create($id)
    {
       if (! Gate::allows('properties_seguros_create')) {
            return abort(401);
        }

        $property = Property::findOrFail($id);//->pluck('name', 'id');

        return view('admin.properties_propietarios.create', compact('property'));
    }

     public function store(StorePropertiesPropietariosRequest $request)
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        
        $propietario = PropertiesPropietarios::create($request->all());
         return redirect()->route('admin.properties.index')
         ->with('flash','Propietario registrado correctamente');

      }

     /**
     * Display Propietario.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('properties_seguros_view')) {
            return abort(401);
        }
        $propietario = PropertiesPropietarios::findOrFail($id);
        $id_propietario=$propietario->id;
        $deducciones = PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
        $total_deducciones=$deducciones->sum('valor');
        $property  = Property::findOrFail($propietario->id_property);
        $fecha_propiedad = Carbon::parse($property->created_at);
        $resul=$property->facturas_pagadas_propiedad($property->id);
        $seguros=PropertiesSeguros::where('id_property','=',$property->id)->get();
        $seguro=PropertiesSeguros::where('id_property','=',$property->id)->first();
        if($seguros->count() > 0) {
        $fecha_inicio_seguro=Carbon::parse($property->seguros->fecha_inicio);
        $fecha_fin_seguro=Carbon::parse($property->seguros->fecha_fin);
        $fecha_actual = Carbon::now();
        } else {
           $fecha_inicio_seguro=Carbon::now();
           $fecha_fin_seguro=Carbon::now();
           $fecha_actual = Carbon::now();
        }
       
         if($seguros->count() > 0) 
            {
            //if($fecha_actual >= $fecha_inicio_seguro)
            //    {
                    $meses_seguro_total=round(($fecha_inicio_seguro->diffInDays($fecha_fin_seguro)/30));
                    $meses_seguro_fecha=round(($fecha_actual->diffInDays($fecha_inicio_seguro)/30));
                    $meses_corridos=round(($fecha_actual->diffInDays($fecha_inicio_seguro)/30));
                    $meses_seguro_consulta=round(($fecha_inicio_seguro->diffInDays($fecha_actual)/30));
                    $costo_seguros=$property->costo_seguros($property->id)*$meses_seguro_fecha;
                    $costo_seguros_total=$property->costo_seguros($property->id)*$meses_corridos;
                 } else {

                    $meses_seguro_total=1;
                    $meses_seguro_fecha=0;
                    $meses_seguro_consulta=1;
                    $costo_seguros=0;
                    $costo_seguros_total=1;
                    $meses_corridos=1;
                    $costo_seguros=0;
                    $costo_seguros_total=0;
                }
           // }

           
       
       

        return view('admin.properties_propietarios.show', compact('propietario','property','resul','costo_seguros_total','costo_seguros','meses_seguro_total','fecha_actual','meses_seguro_fecha','meses_corridos','meses_seguro_consulta','deducciones','total_deducciones'));
       
    }

      public function edit($id)
    {
        if (! Gate::allows('properties_seguros_edit')) {
            return abort(401);
        }

        //$properties = Property::get()->pluck('name', 'id');
        //$unidades = PropertySub::get()->pluck('nombre', 'id');
        //$pago   = PropertiesPagos::findOrFail($id);
        $propietario   = PropertiesPropietarios::findOrFail($id);

        return view('admin.properties_propietarios.edit', compact('propietario'));
    }

      public function update(UpdatePropertiesPropietariosRequest $request, $id)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        $propietario = PropertiesPropietarios::findOrFail($id);
        $id_property=$propietario->id_property;
        $propietario->update($request->all());

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_propietarios_delete')) {
                return abort(401);
            }
            $property=Property::findOrFail($id_property);
            $seguros = PropertiesPropietarios::onlyTrashed()->where('id_property','=',$id_property)->get();
            $id_propietario=$property->propietarios2($property->id)->id;
            $deducciones = PropietariosDeducciones::onlyTrashed()->where('id_propietario','=',$id_propietario)->get();
            $total_deducciones=$deducciones->sum('valor');
        } else {
            $property=Property::findOrFail($id_property);
            $seguros = PropertiesPropietarios::where('id_property','=',$id_property)->get();
            $id_propietario=$property->propietarios2($property->id)->id;
            $deducciones = PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
            $total_deducciones=$deducciones->sum('valor');
        }

        return view('admin.properties_propietarios.index', compact('property','seguros','deducciones','total_deducciones'))
        ->with('flash','Propietario actualizado correctamente');
    }

    public function informe_fechas(Request $request)
    {

     $input = $request->all();
     $id_propietario = $input['id_propietario'];
     $id_property  = $input['id_property'];
     $propietario = PropertiesPropietarios::findOrFail($id_propietario);
     $property = Property::findOrFail($id_property);
    


     //filtro
     $fecha_inicio_informe = Carbon::parse($input['fecha_inicio_informe']);
     $fecha_fin_informe = Carbon::parse($input['fecha_fin_informe']);
      $deducciones = PropietariosDeducciones::where('id_propietario','=',$id_propietario)->where('fecha_deduccion','<',$input['fecha_fin_informe'])->get();
     $total_deducciones=$deducciones->sum('valor');
     //filtro
     
     //numero meses
     $difference=round(($fecha_inicio_informe->diffInDays($fecha_fin_informe)/30));
     $fecha_actual = Carbon::now();
     $fecha=date('Y-m-d');
     $resul=DB::table('properties_pagos')->where('id_property','=',$id_property)->where('fecha_pago','>=',$fecha_inicio_informe)->where('fecha_pago','<=', $fecha_fin_informe)->where('deleted_at','=',NULL)->sum('valor');
   
       
     
     //$fecha_fin1 = '2021-01-01';
     //$fecha_fin=Carbon::parse($fecha_fin1);
     //$difference1=round(($fecha->diffInDays($fecha_fin)/30));
    

       $fecha_propiedad = Carbon::parse($property->created_at);
  //$fecha_fin_seguro=Carbon::parse($property->seguros->fecha_fin);
 //$difference1=round(($fecha_propiedad->diffInDays($fecha_fin_seguro)/30));
        $seguros=PropertiesSeguros::where('id_property','=',$property->id)->get();

  if($seguros->count() > 0) {
  $fecha_inicio_seguro=Carbon::parse($property->seguros->fecha_inicio);
  $fecha_fin_seguro=Carbon::parse($property->seguros->fecha_fin);
  } else {
           $fecha_inicio_seguro=Carbon::now();
           $fecha_fin_seguro=Carbon::now();
           // $fecha_actual = Carbon::now();
 }

  if($seguros->count() > 0)
  {

      if($input['fecha_fin_informe'] >= $property->seguros->fecha_inicio)
       {  
        $meses_corridos=round(($fecha_fin_informe->diffInDays($fecha_inicio_seguro)/30));
        } else {
            $meses_corridos=0;
        }
    }
  

 if($seguros->count() > 0)
  {
        $meses_seguro_total=round(($fecha_inicio_seguro->diffInDays($fecha_fin_seguro)/30));
       $meses_seguro_fecha=round(($fecha_actual->diffInDays($fecha_inicio_seguro)/30));
       $meses_seguro_consulta=round(($fecha_inicio_informe->diffInDays($fecha_fin_informe)/30));
       $costo_seguros=$property->costo_seguros($property->id)*$meses_seguro_fecha;
       $costo_seguros_total=$property->costo_seguros($property->id)*$meses_seguro_consulta;
    } else {
           $meses_seguro_total=0;
           $meses_seguro_fecha=0;
           $meses_seguro_consulta=1;
           $costo_seguros=0;
           $costo_seguros_total=0;
           $meses_corridos=0;
    }

  
     return view('admin.properties_propietarios.show',compact('property','propietario','resul','costo_seguros_total','costo_seguros','meses_seguro_total','meses_seguro_fecha','meses_corridos','meses_seguro_consulta','deducciones','total_deducciones'));
 }

          public function informe_propietario()
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            $facturas = PropertiesFacturas::onlyTrashed()->get();
        } else {
            $facturas = PropertiesFacturas::all();
        }

        return view('admin.properties_propietarios.informe_propietario', compact('facturas'));
    }


}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreTenantsRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Notifications\InvitationSend;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Property;
use App\PropertySub;
use App\PropertiesFacturas;
use App\PropietariosDeducciones;
use App\PropertiesPropietarios;
use App\PropertyType;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Exports\PropertiesFacturasExport;
use App\Exports\PropertiesFacturasExportQuery;
use App\Exports\PropertiesFacturasExportView;
use Illuminate\Contracts\View\View;
use DB;
//use Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\Exportable;
//use App\Exports;
//use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use Hash;
use App\Http\Controllers\Traits\FileUploadTrait;

class TenantsController extends Controller
{
    use SoftDeletes;
    use Exportable;
    use FileUploadTrait;

    /**
     * Display a listing of Tenants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
        $tenants = User::whereIn('property_id', Property::where('user_id', auth()->user()->id)->pluck('id'))->onlyTrashed()->get();
      } else {

         $tenants = User::whereIn('property_id', Property::where('user_id', auth()->user()->id)->pluck('id'))->get();
     }

        return view('admin.tenants.index', compact('tenants'));
    }

     public function facturas_tenant_consulta($id)
    {
        //$tenants = User::whereIn('property_id', Property::where('user_id', auth()->user()->id)->pluck('id'))->get();
        //$facturas = \App\PropertiesFacturas::all()->pluck('valor');
        $facturas = DB::table('properties_facturas')->where('id_tenant','$id')->get();
        //$facturas = PropertiesFacturas::all();

        //return view('admin.tenants.index', compact('tenants','facturas'));
        //return view('admin.tenants.index', compact('tenants'));
        return view('admin.properties_facturas.index', compact('facturas'));
    }

     public function inquilinos_consulta($id)
    {
        //$tenants = User::whereIn('property_id', $id)->get();
        $tenants = User::whereIn('property_id', Property::where('id', $id)->pluck('id'))->orderBy('created_at','DESC')->get();
        //$tenants = User::whereIn('property_id', Property::where('id', $id),'role_id', Role::where('id', 3)->pluck('id'))->get();
        //$tenants = User::whereIn('role_id',[2,3])->pluck('role_id')->whereIn('property_id', Property::where('id', $id)->pluck('id'))->get();

        return view('admin.tenants.index', compact('tenants'));
    }

        public function inquilinos_consulta_unidad($id)
    {
        //$tenants = User::whereIn('property_id', $id)->get();
        $tenants = User::whereIn('property_sub_id', PropertySub::where('id', $id)->pluck('id'))->orderBy('created_at','DESC')->get();
        //$tenants = User::whereIn('property_id', Property::where('id', $id),'role_id', Role::where('id', 3)->pluck('id'))->get();
        //$tenants = User::whereIn('role_id',[2,3])->pluck('role_id')->whereIn('property_id', Property::where('id', $id)->pluck('id'))->get();

        return view('admin.tenants.index', compact('tenants'));
    }

        public function inquilinos_renovacion_contrato()
    {
      $usuarios = User::where('estado',1)->where('deleted_at','=',NULL)->where('role_id','!=',1)->get();

        return view('admin.tenants.tenants_renovacion_contrato', compact('usuarios'));
    }

    /**
     * Show the form for creating new Tenant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id');

        return view('admin.tenants.create', compact('properties'));
    }

    public function create_tenant_propiedad_unidad($id)
    {
        
        //$id_tenant=$id;
        $properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id');
        $property=PropertySub::findOrFail($id);
        $tipos = PropertyType::whereIn('id',[3,4,5])->pluck('tipo', 'id');

        return view('admin.tenants.create', compact('properties','property','tipos'));
    }

    /**
     * Store a newly created Tenant in storage.
     *
     * @param  \App\Http\Requests\StoreTenantsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenantsRequest $request)
    {
        $user = User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'cedula'           => $request->cedula,
            'phone'            => $request->phone,
            'referencias'      => $request->referencias,
            'fecha_inicio_contrato' => $request->fecha_inicio_contrato,
            'fecha_fin_contrato' => $request->fecha_fin_contrato,
            //'fecha_fin_contrato' => $request->fecha_inicio_contrato,
            'duracion_meses'    => $request->duracion_meses,
            //'duracion_meses'    => 3,

            'codeudor'         => $request->codeudor,
            'email_codeudor'   => $request->email_codeudor,
            'cc_codeudor'      => $request->cc_codeudor,
            'tel_codeudor'     => $request->tel_codeudor,
            'dir_codeudor'     => $request->dir_codeudor,
            'ref_codeudor'     => $request->ref_codeudor,
            'duracion_contrato'=> $request->duracion_contrato,

            'password'         => str_random(8),
            'property_id'      => $request->property_id,
            'property_sub_id'  => $request->property_sub_id,

            'role_id'      => 3,
            'invitation_token' => substr(md5(rand(0, 9) . $request->email . time()), 0, 32),
        ]);

        $user->role()->attach(3);
        //Actualizar unidad
        $id_unidad=$request->property_sub_id;
        $unidad=PropertySub::findOrFail($id_unidad);
        $unidad->id_tenant=$user->id;
        $unidad->update();
        //Actualizar unidad

        //Crear Factura
        $fecha_actual=Carbon::now();
        $fecha_tenant=$user->created_at;
        $fecha_tenant2=Carbon::parse($fecha_tenant);
        $difference = $fecha_actual->diffInDays($fecha_tenant2);

        if($difference <= 29) {

        $mes=date('m');
        $mes2=date('m');
        $factura= new PropertiesFacturas;
        $factura->id_property = $request->property_id;
        $factura->id_property_sub = $request->property_sub_id;
        $factura->id_tenant = $user->id;
        $factura->id_estado = 1;
        $factura->fecha_inicio = '2021-'.$mes++.'-01';
        $factura->fecha_corte = '2021-'.$mes2++.'-01';
        $factura->valor_neto = $unidad->renta;
        $factura->save();
    }
        $property=$factura->id_property;


        //$user->notify(new InvitationSend());

        //return redirect()->route('admin.properties.show',compact('property'))
        //    ->with('flash','Inquilino guardado correctamente');

         $documents = \App\Document::where('tenant_id', $user->id)->get();
         $notes     = \App\PropertiesFacturas::where('id_tenant', $user->id)->get();
         $tenant  = $user;
        //$tenant  = User::findOrFail($id);
         $facturas = \App\PropertiesFacturas::where('id_tenant', $user->id)->get();
         return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'))
            
         ->with('flash','Inquilino guardado correctamente');

     }

        /**
     * Show the form for editing Tenant.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //if (! Gate::allows('tenant_edit')) {
        //    return abort(401);
        //}

        //$tenant = 2;
        $tenant = User::findOrFail($id);
        //$property = Property::where('user_id', auth()->user()->id)->pluck('name', 'id');

        //return view('admin.tenants.edit', compact('property'));
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update Tenant in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        $tenant = User::findOrFail($id);
        $tenant->update($request->all());
        $facturas = PropertiesFacturas::where('id_tenant',$id)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $id)->get();
        $documents = \App\Document::where('property_id', $tenant->property_id)->get();
        
        return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes'))
       
        ->with('flash','El siguiente cliente ha sido actualizado: '
                .$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );
    }


    /**
     * Display Tenant.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('property_view')) {
            return abort(401);
        }
    $documents = \App\Document::where('tenant_id', $id)->get();
    $notes     = \App\PropertiesFacturas::where('id_tenant', $id)->get();
    $tenant  = User::findOrFail($id);
    //$property  = User::findOrFail($id);
    $facturas = \App\PropertiesFacturas::where('id_tenant', $id)->orderBy('fecha_inicio','DESC')->get();
    //$facturas = PropertiesFacturas::where('id_tenant','=', 28)->get();
    //$porpagar = count($facturas);
    //$porpagar =
    //$sum = 0;
    //foreach ($facturas as $key => $object) {
    //$k = key($object);
    //$sum += $object->{$k};
    //}
    //echo $sum;

       return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'));
       //  return view('admin.tenants.show', compact('property', 'documents', 'notes'));
    }


    /**
     * Remove Tenant from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $property = User::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.tenants.index');
    }

    /**
     * Restore Tenant from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('property_sub_delete')) {
            return abort(401);
        }

        $tenant = User::onlyTrashed()->findOrFail($id);
        $tenant->restore();

        return redirect()->route('admin.tenants.index');
    }

     /**
     * Delete all selected Tenant at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Permanently delete Property from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('property_sub_delete')) {
            return abort(401);
        }

        $tenant = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.tenants.index');
    }

     public function informe_inquilinos_consulta($id)
    {
        $fecha_inicio_informe = 0;
        $fecha_fin_informe = 0;
        $propiedad=Property::findOrFail($id);
        $id_propiedad=$propiedad->id;
        $propietario=$propiedad->propietarios2($id_propiedad);
        $id_propietario=$propiedad->propietarios2($id_propiedad)->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad($propiedad->id);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;

        return view('admin.tenants.informe_inquilinos_consulta', compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe'))
        ->with('msj','');
    }

     public function informe_inquilinos_consulta_fechas(Request $request)
    {
        $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;
        return view('admin.tenants.informe_inquilinos_consulta',compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe','propietario'))
        ->with('msj','Informe Generado');
    }

      public function imprimir_informe(Request $request)
      {
        $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;
       
      $pdf= \PDF::loadView('admin.tenants.informe_inquilinos_consulta_imprimir',compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe','propietario'));  

      //$pdf = \PDF::loadView('admin.tenants.informe_inquilinos_consulta_imprimir',compact('factura','facturas'));
    // return $pdf->download('informe_colhouse.pdf');
    return $pdf->download('InformeColhouse-CC'.$propietario->cedula.'-'.$fecha_inicio_informe.'-'.$fecha_fin_informe.'-'.$propietario->nombre.'.pdf');
    }

      public function export_informe_excel(Request $request)
      {
        $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;

         $data = array(
            'fecha_inicio_informe'  => $fecha_inicio_informe,
            'fecha_fin_informe'     => $fecha_fin_informe,
            'propietario'           => $propietario,
            'tenants'               => $tenants,
            'ingresos'              => $ingresos,
            'administracion'        => $administracion,
            'deducciones'           => $deducciones,
            'deducciones_detalles'  => $deducciones_detalles,
            'valor_pagar'           => $valor_pagar,
            //'email_propietario'     => $email_propietario,
            'propietario'           => $propietario,
            'propiedad'             => $propiedad,
        );
       
   /*return new Excel ('admin.tenants.informe_inquilinos_consulta_imprimir', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            }
                            );
            });
            //})download($type);*/
    //$excel=new Excel ('admin.tenants.informe_inquilinos_consulta_imprimir', function($excel) use ($data) {
    //$excel= new Excel ('admin.tenants.informe_inquilinos_consulta_imprimir',$data);
    //$excel= function() use ($data) {
    //$excel::download('data','InformeColhouse-CC'.$propietario->cedula.'-'.$fecha_inicio_informe.'-'.$fecha_fin_informe.'-'.$propietario->nombre.'.xlxs');
     //});
          //     });
     //    return $excel::download('admin.tenants.informe_inquilinos_consulta_imprimir','archivo.xlsx');
    //};

          return Excel::download( new Excel('admin.tenants.informe_inquilinos_consulta_imprimir',$data), 'encuestas.xls');
   


    }

     public function enviar_informe(Request $request)
    {
        //$data["email"] = "ricaza81@gmail.com";
        //$data["title"] = "Informe";
        //$data["body"] = "This is the email body.";

        //$input = $request->all();
       
       
      //$pdf= \PDF::loadView('admin.tenants.informe_inquilinos_consulta_imprimir',compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe','propietario'));

        $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;
        $email_propietario=$input['email_propietario'];

       $data = array(
            'fecha_inicio_informe'  => $fecha_inicio_informe,
            'fecha_fin_informe'     => $fecha_fin_informe,
            'propietario'           => $propietario,
            'tenants'               => $tenants,
            'ingresos'              => $ingresos,
            'administracion'        => $administracion,
            'deducciones'           => $deducciones,
            'deducciones_detalles'  => $deducciones_detalles,
            'valor_pagar'           => $valor_pagar,
            'email_propietario'     => $email_propietario,
            'propietario'           => $propietario,
            'propiedad'             => $propiedad,
        );

       

      
       $pdf = \PDF::loadView('admin.tenants.informe_inquilinos_consulta_enviar', $data);

        Mail::send('admin.tenants.informe_inquilinos_consulta_enviar',$data,  function ($message) use ($data,$email_propietario,$propietario,$propiedad,$pdf) {
            $message->to
    ($email_propietario,'ricaza81@gmail.com')
    ->cc('laurazambranoduran.abogada@gmail.com')
            //$message->to('ricaza81@gmail.com')
                ->subject('Informe Propietario'.'-'.$propietario->nombre.'-'.$propiedad->name)
                ->attachData($pdf->output(), "InformeColHouse.pdf");
        });

        //dd('Email has been sent successfully');
         $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
        $valor_pagar=$ingresos-$administracion-$deducciones;
        return view('admin.tenants.informe_inquilinos_consulta',compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe','propietario'))
        ->with('msj','Reporte enviado correctamente al propietario '.$propietario->nombre.' con email '.$email_propietario);
    }


 /* public function crearEXCEL($tipo)
    {

          $excel=new Excel('Prospectos_VLF', function($excel) {
 
            $excel->sheet('Prospectos', function($sheet) {
 
                $products = PropertiesPropietarios::all();
 
                $sheet->fromArray($products);
 
            });
        });//->export('xls');

          if($tipo==1){return $excel::download('products','archivo.xlsx');}
        //if($tipo==2){return $excel::download('reporte.xlsx'); }
    }*/

    public function crearEXCEL()
    {

    return Excel::download(new PropertiesFacturasExport, 'Facturas.xlsx');
    }

    public function crearEXCELquery()
    {

    return (new PropertiesFacturasExportQuery)->download('FacturasQuery.xlsx');
    }

    public function crearEXCELview(Request $request)
    {
        

    $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
            $valor_pagar=$ingresos-$administracion-$deducciones;

        return view('admin.tenants.informe_inquilinos_consulta_imprimir',
        
        [   'tenants'               =>  $tenants,
            'id_propiedad'          =>  $id_propiedad,
            'ingresos'              =>  $ingresos,
            'administracion'        =>  $administracion,
            'deducciones'           =>  $deducciones,
            'valor_pagar'           =>  $valor_pagar,
            'id_propietario'        =>  $id_propietario,
            'deducciones_detalles'  =>  $deducciones_detalles,
            'fecha_inicio_informe'  =>  $fecha_inicio_informe,
            'fecha_fin_informe'     =>  $fecha_fin_informe,
            'propietario'           =>  $propietario
        ]);
        //->download('FacturasQuery.xlsx');
    }

 

}

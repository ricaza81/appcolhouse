<?php

namespace App\Http\Controllers\Admin;

use App\PropertiesPagos;
use App\PropertiesFacturas;
use App\PropertySub;
use App\PropertySubCanon;
use App\Property;
use App\Documents;
use App\User;
use Mail;
use App\Notifications\FacturaSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentsRequest;
use App\Http\Requests\Admin\StorePropertiesFacturasRequest;
use App\Http\Requests\Admin\UpdatePropertiesFacturasRequest;
use App\Http\Requests\Admin\UpdateDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;
use DB;

class PropertiesFacturasController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        return view('admin.properties_facturas.index', compact('facturas'));
    }

      public function facturas_consulta($id)
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            //$facturas = PropertiesFacturas::where('id_property_sub',$id)::onlyTrashed()->get();
             $property=PropertySub::findOrFail($id);
            $facturas = PropertiesFacturas::where('id_property_sub',$id)->get();
        } else {
            $facturas = PropertiesFacturas::where('id_property_sub',$id)->get();
             $property=PropertySub::findOrFail($id);
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
    }

      /**
     * Display a listing Invoices Properties.
     *
     * @return \Illuminate\Http\Response
     */
        public function facturas_propiedad_consulta($id)
    {
        
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
        //$facturas = PropertiesFacturas::onlyTrashed()->get();
        $facturas = PropertiesFacturas::onlyTrashed()->orderBy('created_at','DESC')->get();
        //$facturas = PropertiesFacturas::all();
        $property=Property::findOrFail($id);
            //$tenant='';
        } else {
        $facturas = PropertiesFacturas::where('id_property',$id)->where('deleted_at',NULL)->orderBy('created_at','DESC')->get();
            $property=Property::findOrFail($id);
            //$tenant='';
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
    }

         public function facturas_vencidas_propiedad_consulta($id)
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            //$facturas = PropertiesFacturas::where('id_property_sub',$id)::onlyTrashed()->get();
            $facturas = PropertiesFacturas::where('id_property',$id)->where('deleted_at',NULL)->where('id_estado',1)->onlyTrashed()->get();
            $property=Property::findOrFail($id);
        } else {
            $facturas = PropertiesFacturas::where('id_property',$id)->where('deleted_at',NULL)->where('id_estado',1)->get();
            $property=Property::findOrFail($id);
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
    }

          public function facturas_vencidas_propiedad_consulta1($id)
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            //$pago_facturas = PropertiesFacturas::where('id_property',$id)->where('deleted_at',NULL)->where('id_estado',1)->onlyTrashed()->get();
            //$pagos=PropertiesPagos::where('id_property',$id)->where('deleted_at',NULL)->sum('valor');
            $facturas=PropertiesFacturas::where('id_property',$id)->where('deleted_at',NULL)->onlyTrashed()->sum('valor_neto') >  PropertiesPagos::where('id_property',$id)->where('deleted_at',NULL)->sum('valor');
            $property=Property::findOrFail($id);
        } else {
            $facturas=PropertiesFacturas::where('id_property',$id)->sum('valor_neto') >  PropertiesPagos::where('id_property',$id)->sum('valor');
            $property=Property::findOrFail($id);
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
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
            //$tenant=User::findOrFail($id);
            $property=Property::findOrFail($tenant->property_id);
            $facturas = PropertiesFacturas::where('id_tenant',$id)->onlyTrashed()->get();
        } else {
            //$tenant=User::findOrFail($id);
            $property=Property::findOrFail($tenant->property_id);
            $facturas = PropertiesFacturas::where('id_tenant',$id)->where('deleted_at','=',NULL)->get();
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
    }

         public function facturas_tenant_vencidas($id)
    {
        if (! Gate::allows('properties_facturas_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_facturas_delete')) {
                return abort(401);
            }
            //$tenant=User::findOrFail($id);
            $property=Property::findOrFail($tenant->property_id);
            $facturas = PropertiesFacturas::where('id_tenant',$id)->where('id_estado',1)->onlyTrashed()->get();
        } else {
            
            $tenant=User::findOrFail($id);
            $property=Property::findOrFail($tenant->property_id);$facturas = PropertiesFacturas::where('id_tenant',$id)->where('id_estado',1)->get();
             $facturas = PropertiesFacturas::where('id_tenant',$id)->where('id_estado',1)->get();
        }

        return view('admin.properties_facturas.index', compact('facturas','property'));
            //->with('flash','Inquilino:');
        ;
    }

    /**
     * Show the form for creating new Document.
     *
     * @return \Illuminate\Http\Response
     */
   public function create($id)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        $properties = PropertySub::findOrFail($id);//->pluck('name', 'id');
        $canon = PropertySubCanon::where('id_property_sub',$id)->get();

        return view('admin.properties_facturas.create', compact('properties','canon'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentsRequest $request
     * @return \Illuminate\Http\Response
     */
  /*public function store(StorePropertiesFacturasRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        $document = PropertiesFacturas::create($request->all() + ['id_estado' => 1]);

        //$user=$document->tenant->email;
        //$user='ricaza81@gmail.com';
        //dd(auth()->user());
        $user=auth()->user()->email;
        //dd($document);
        //$document->notify(new FacturaSend());
        //$user->notify(new FacturaSend($document));
        $user->notify(new FacturaSend());
        return redirect()->route('admin.properties_facturas.index');
    }*/
 public function imprimir($id){
     //$pdf = \PDF::loadView('ejemplo');
     //return $pdf->download('ejemplo.pdf');

      $factura = PropertiesFacturas::findOrFail($id);
      $facturas = PropertiesPagos::where('id_factura',$id)->get();
      $id_tenant=$factura->tenant->id;
      $tenant=User::findOrFail($id_tenant);
      $fecha_fin_contrato=$tenant->fecha_fin_contrato;
      //$fecha_limite_renovacion= Carbon::parse($fecha_fin_contrato);
      $fecha_limite_renovacion1= strtotime ( '-90 day' , strtotime ( $fecha_fin_contrato));
      $fecha_limite_renovacion = date ( 'Y-m-d' , $fecha_limite_renovacion1 );

      $pdf = \PDF::loadView('admin.properties_facturas.facturapdf',compact('factura','facturas','fecha_fin_contrato','fecha_limite_renovacion'));
     return $pdf->download('Factura COL-HT-'.$factura->id.'-'.$factura->tenant->name.'-'.$factura->fecha_inicio.'.pdf');
    }

     public function store(StorePropertiesFacturasRequest $request)
    {
        if (! Gate::allows('document_create')) {
            return abort(401);
        }
        //$asunto='Nueva factura creada';
        //$ultimoidfactura=PropertiesFacturas::all()->last()->id;
        //$ultimafactura=DB::table('properties')->where('created_at','!=',NULL)->get()->last();
        //$ultimoidfactura=$ultimafactura->id;
        //$factura = PropertiesFacturas::create($request->all()
        //    + ['id_estado' => 1] + ['id' => $ultimoidfactura++]);
        $factura = PropertiesFacturas::create($request->all() + ['id_estado' => 1]);
        $property_bd=Property::findOrFail($factura->id_property);
        $property=$factura->id_property;
        $facturas = PropertiesFacturas::where('id_property',$factura->id_property)->orderBy('created_at','DESC')->get();
        $id_tenant=$factura->tenant->id;
        $documents = \App\Document::where('property_id', $factura->id_property)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $factura->id_property)->get();
        $tenant=User::findOrFail($id_tenant);
        $fecha_fin_contrato=$tenant->fecha_fin_contrato;
        $fecha_limite_renovacion1= strtotime ( '-90 day' , strtotime ( $fecha_fin_contrato));
        $fecha_limite_renovacion = date ( 'Y-m-d' , $fecha_limite_renovacion1 );

         $data = array(
         'factura'                  => $factura,
         'id_tenant'                => $id_tenant,
         'tenant'                   => $tenant,
         'fecha_fin_contrato'       => $fecha_fin_contrato,
         'fecha_limite_renovacion'  => $fecha_limite_renovacion,
        );

        $pdf = \PDF::loadView('admin.properties_facturas.facturapdf',compact('factura','facturas','fecha_fin_contrato','fecha_limite_renovacion'));

        Mail::send('correo.plantilla_factura', $data, function ($message)
            use ($factura,$fecha_fin_contrato,$fecha_limite_renovacion,$pdf) {
        $message->from('ricaza81@gmail.com', 'ColHouse');
        $message->to('ricaza81@gmail.com')
        ->cc('laurazambranoduran.abogada@gmail.com')
        ->subject('Nueva factura creada')
        ->attachData($pdf->output(), "Factura COL-FT-".$factura->id.".pdf");
        });
          return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes'))
       
         ->with('flash','Factura # COL-FT-'.$factura->id.' ha sido creada y enviada correctamente a '
                .$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );
    }


    /**
     * Show the form for editing Document.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        $properties = \App\Property::get()->pluck('name','id');
        $document   = PropertiesFacturas::findOrFail($id);

        return view('admin.properties_facturas.edit', compact('document', 'properties'));
    }

    /**
     * Update Document in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertiesFacturasRequest $request, $id)
    {
        if (! Gate::allows('document_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        $document = PropertiesFacturas::findOrFail($id);
        $document->update($request->all());
        $property_bd=Property::findOrFail($document->id_property);
        $property=$document->id_property;
        $facturas = PropertiesFacturas::where('id_property',$document->id_property)->get();
        $id_tenant=$document->tenant->id;
        $documents = \App\Document::where('property_id', $document->id_property)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $document->id_property)->get();
        $tenant=User::findOrFail($id_tenant);

        $factura = PropertiesFacturas::findOrFail($id);
        $facturas = PropertiesPagos::where('id_factura',$id)->get();
        return view('admin.properties_facturas.show', compact('factura','facturas'))
        ->with('flash','Factura # COL-FT-'.$document->id.' ha sido actualizada correctamente');

        /*return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes'))
       
         ->with('flash','Factura # COL-FT-'.$document->id.' ha sido actualizada correctamente'
                .$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );*/
    }


    /**
     * Display Factura.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('properties_facturas_view')) {
            return abort(401);
        }

        $factura = PropertiesFacturas::findOrFail($id);
        $facturas = PropertiesPagos::where('id_factura',$id)->get();
        //$pagos = PropertiesPagos::where('id_factura',$id)->get();

        return view('admin.properties_facturas.show', compact('factura','facturas'));
    }


    /**
     * Remove Document from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = PropertiesFacturas::findOrFail($id);
        $factura = PropertiesFacturas::findOrFail($id);
        $id_property= $document->id_property;
        $id_tenant= $document->id_tenant;
        $property=Property::findOrFail($id_property);     
        $document->delete();
        $facturas = PropertiesFacturas::where('id_property',$id_property)->where('deleted_at',NULL)->get();
        $documents = \App\Document::where('property_id', $document->id_property)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $document->id_property)->get();
        $tenant=User::findOrFail($id_tenant);
       // $url= route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) ?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '';
        $url = 'https://www.google.com';
        
        return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes','factura','url'))
       
                 ->with('flash','Factura # COL-FT-'.$factura->id.' ha sido trasladada correctamente a la papelera. No olvides eliminarla o restaurarla '.$tenant->name.$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );
       
    }

    /**
     * Delete all selected Document at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Document::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Factura from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = PropertiesFacturas::onlyTrashed()->findOrFail($id);
        $factura = PropertiesFacturas::onlyTrashed()->findOrFail($id);
        $id_property= $document->id_property;
        $id_tenant=$document->id_tenant;
        $property=Property::findOrFail($id_property);
        $document->restore();
        $facturas = PropertiesFacturas::where('id_property',$id_property)->where('deleted_at',NULL)->get();
        $documents = \App\Document::where('property_id', $document->id_property)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $document->id_property)->get();
        $tenant=User::findOrFail($id_tenant);
   return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes','factura'))
       
         ->with('flash','Factura # COL-FT-'.$factura->id.' ha sido restaurada correctamente. '
                .$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );
    }

    /**
     * Permanently delete Factura from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('document_delete')) {
            return abort(401);
        }

        $document = PropertiesFacturas::onlyTrashed()->findOrFail($id);
        $factura = PropertiesFacturas::onlyTrashed()->findOrFail($id);
        $id_tenant=$document->id_tenant;
        $tenant=User::findOrFail($id_tenant);
        $id_property= $document->id_property;
        $documents = \App\Document::where('property_id', $document->id_property)->get();
        $notes     = \App\PropertiesFacturas::where('id_tenant', $document->id_property)->get();
        $property=Property::findOrFail($id_property);     
        $document->forceDelete();
        $facturas = PropertiesFacturas::where('id_property',$id_property)->where('deleted_at',NULL)->get();

        return redirect()->route('admin.tenants.show',compact('tenant','facturas','documents','notes'))
       
         ->with('flash','Factura # COL-FT-'.$factura->id.' ha sido borrada correctamente. '
                .$tenant->name.' ('.$tenant->email.') de la unidad '.$tenant->subproperty->nombre.' en la propiedad '.$tenant->property->name
                );
    }

    //Generar PDF
   
     public function imprimir2(){
     if (! Gate::allows('properties_facturas_view')) {
            return abort(401);
        }

        $factura = PropertiesFacturas::findOrFail($id);
        $facturas = PropertiesPagos::where('id_factura',$id)->get();
        //$pagos = PropertiesPagos::where('id_factura',$id)->get();

        return view('admin.properties_facturas.show', compact('factura','facturas'));

    }

    //Generar PDF
}

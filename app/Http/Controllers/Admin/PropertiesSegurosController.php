<?php

namespace App\Http\Controllers\Admin;

//use App\PropertiesFacturas;
//use App\PropertiesPagos;
use App\Property;
use App\PropertySub;
use App\User;
use App\PropertiesSeguros;
use App\SystemParams;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertiesSegurosRequest;
use App\Http\Requests\Admin\UpdatePropertiesSegurosRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;

class PropertiesSegurosController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Seguros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('properties_seguros_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('properties_seguros_delete')) {
                return abort(401);
            }
            $seguros = PropertiesSeguros::onlyTrashed()->get();
            //$facturas = PropertiesPagos::all();
        } else {
            $seguros = PropertiesSeguros::all();
        }

        return view('admin.properties_seguros.index', compact('seguros'));
    }



    /**
     * Show the form for creating new Seguro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (! Gate::allows('properties_seguros_create')) {
            return abort(401);
        }

        $property = PropertySub::findOrFail($id);//->pluck('name', 'id');

        return view('admin.properties_seguros.create', compact('property'));
    }

    /**
     * Store a newly created Seguro in storage.
     *
     * @param  \App\Http\Requests\StorePropertiesSegurosRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertiesSegurosRequest $request)
    {
        if (! Gate::allows('properties_seguros_create')) {
            return abort(401);
        }

        $seguro = PropertiesSeguros::create($request->all());
        $id_property_sub = $seguro->id_property_sub;
        $property_sub = PropertySub::findOrFail($id_property_sub);
        $id_tenant=$property_sub->id_tenant;
        $tenant = User::findOrFail($id_tenant);
        $facturas = \App\PropertiesFacturas::where('id_tenant', $id_tenant)->orderBy('fecha_inicio','DESC')->get();
        $documents = \App\Document::where('tenant_id',$id_tenant)->get();
        $notes = \App\PropertiesFacturas::where('id_tenant', $id_tenant)->orderBy('fecha_inicio','DESC')->get();
         

        return view('admin.tenants.show', compact('tenant','facturas','documents', 'notes'))       
            ->with('flash','Seguro registrado correctamente');
    }


    /**
     * Show the form for editing Seguro.
     *s
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('properties_seguros_edit')) {
            return abort(401);
        }

        //$properties = Property::get()->pluck('name', 'id');
        //$unidades = PropertySub::get()->pluck('nombre', 'id');
        //$pago   = PropertiesPagos::findOrFail($id);
        $seguro   = PropertiesSeguros::findOrFail($id);
        $porc_seguro=SystemParams::findOrFail(1);
        //$porc_seguro1=$porc_seguro1*100;

        return view('admin.properties_seguros.edit', compact('seguro','porc_seguro'));
    }

    /**
     * Update Seguro in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesSegurosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertiesSegurosRequest $request, $id)
    {
       if (! Gate::allows('properties_seguros_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);*/
        $seguro = PropertiesSeguros::findOrFail($id);

        if($seguro->estado == 1) {
            $seguro->update($request->all() + ['estado' => 2]);
        }
        else {
             $seguro->update($request->all() + ['estado' => 1]);
        }


        return redirect()->route('admin.properties_sub.index')
        ->with('flash','Seguro actualizado correctamente');
    }


    /**
     * Display Seguro.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('properties_seguros_view')) {
            return abort(401);
        }

        $seguro = PropertiesSeguros::findOrFail($id);

        return view('admin.properties_seguros.show', compact('seguro'));
    }


    /**
     * Remove Seguro from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('properties_seguros_delete')) {
            return abort(401);
        }

        $seguro = PropertiesSeguros::findOrFail($id);
        $seguro->delete();
        

        return redirect()->route('admin.properties.index');
    }

    /**
     * Delete all selected Seguros at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('properties_seguros_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = PropertiesSeguros::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Seguro from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('properties_seguros_view')) {
            return abort(401);
        }

        $seguro = PropertiesSeguros::onlyTrashed()->findOrFail($id);
        $seguro->restore();

        return redirect()->route('admin.properties.index');
    }

    /**
     * Permanently delete Seguro from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('properties_seguros_delete')) {
            return abort(401);
        }

        $seguro = PropertiesSeguros::onlyTrashed()->findOrFail($id);
        $seguro->forceDelete();

        return redirect()->route('admin.properties.index');
    }
}

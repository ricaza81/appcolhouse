<?php

namespace App\Http\Controllers\Admin;

//use App\PropertiesFacturas;
//use App\PropertiesPagos;
use App\Property;
use App\PropertySub;
//use App\Documents;
use App\PropertiesSeguros;
use App\PropertiesPropietarios;
use App\PropietariosDeducciones;
use App\SystemParams;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropietariosDeduccionesRequest;
use App\Http\Requests\Admin\UpdatePropietariosDeduccionesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;

class PropietariosDeduccionesController extends Controller
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
    public function store(StorePropietariosDeduccionesRequest $request)
    {
        if (! Gate::allows('properties_seguros_create')) {
            return abort(401);
        }
        //$deduccion = PropietariosDeducciones::create($request->all() + ['valor' => $request['valor']*1000]);
        $deduccion = PropietariosDeducciones::create($request->all());
        $input = $request->all();
        $id_property  = $input['id_property'];
        $id_propietario  = $input['id_propietario'];
        $property= Property::findOrFail($id_property);
        $seguros=PropertiesSeguros::where('id_property','=',$property->id)->get();
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
        $total_deducciones=$deducciones->sum('valor');

         return redirect()->route('admin.properties_propietarios.index', compact('property','seguros','deducciones','total_deducciones'));
        //  return view('admin.properties_propietarios.index', compact('property','seguros','deducciones','total_deducciones'));
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

        $deduccion   = PropietariosDeducciones::findOrFail($id);
        $porc_seguro=SystemParams::findOrFail(1);
        //$input = $request->all();
        $id_propietario  = $deduccion->id_propietario;
        $propietario=PropertiesPropietarios::findOrFail($id_propietario);
        $id_property  = $propietario->id_property;
        $property= Property::findOrFail($id_property);
        //$seguros=PropertiesSeguros::where('id_property','=',$property->id)->get();
        //$deducciones=PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
        //$total_deducciones=$deducciones->sum('valor');

        return view('admin.properties_propietarios.editdeduccion', compact('deduccion','porc_seguro','property'));
    }

    /**
     * Update Seguro in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesSegurosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropietariosDeduccionesRequest $request, $id)
    {
       if (! Gate::allows('properties_seguros_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);*/
        $deduccion = PropietariosDeducciones::findOrFail($id);
        $deduccion->update($request->all());
        $input = $request->all();
        $id_property  = $input['id_property'];
        $id_propietario  = $input['id_propietario'];
        $property= Property::findOrFail($id_property);
        $seguros=PropertiesSeguros::where('id_property','=',$property->id)->get();
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$id_propietario)->get();
        $total_deducciones=$deducciones->sum('valor');


        return redirect()->route('admin.properties_propietarios.index',compact('property','seguros','deducciones','total_deducciones'))
        ->with('flash','Deducción actualizada correctamente');
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

        $deduccion   = PropietariosDeducciones::findOrFail($id);
        $porc_seguro=SystemParams::findOrFail(1);

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

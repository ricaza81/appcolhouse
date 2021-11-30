<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Property;
use App\PropertySub;
use App\PropertyType;
use App\PropertiesSeguros;
use App\PropertiesPropietarios;
use App\PropertiesFacturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertiesRequest;
use App\Http\Requests\Admin\UpdatePropertiesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;

class PropertiesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('property_access')) {
            return abort(401);
        }

         $fecha=date('Y-m-d');
         $fecha2 = Carbon::now();
        if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
            $properties = Property::onlyTrashed()->get();
            //$properties = Property::onlyTrashed()->orderBy('created_at','DESC')->get();
            //$unidades = PropertySub::onlyTrashed()->get();
            // $properties = Property::all()->where('deleted_at',NULL);
            $unidades = PropertySub::all()->where('deleted_at',NULL);
            $inquilinos = User::onlyTrashed()->where('role_id','!=',1)->get();
            $seguros=PropertiesSeguros::onlyTrashed()->get();
            $propietarios=PropertiesPropietarios::onlyTrashed()->get();
            $facturas=PropertiesFacturas::onlyTrashed()->where('id_estado','=',1)->get()->sum('valor_neto');
            /*$zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');*/

            //$fecha=date('Y-m-d');
        } else {
            $properties = Property::where('deleted_at',NULL)->orderBy('created_at','DESC')->get();
            //$properties = Property::all()->where('deleted_at',NULL);
            //$properties = Property::all()->where('deleted_at',NULL)->orderBy('created_at','DESC')->get();
            $unidades = PropertySub::all()->where('deleted_at',NULL);
            $inquilinos = User::where('role_id','!=',1)->where('deleted_at',NULL)->get();
            $seguros = PropertiesSeguros::all()->where('deleted_at',NULL);
            $propietarios =PropertiesPropietarios::all()->where('deleted_at',NULL);
            $facturas=PropertiesFacturas::where('id_estado','=',1)->where('deleted_at',NULL)->get()->sum('valor_neto');
            /*$zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');*/
        }

        return view('admin.properties.index', compact('properties','fecha','fecha2','unidades','inquilinos','seguros','propietarios','facturas'));
    }

      public function index_tabla()
    {
        if (! Gate::allows('property_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
            $properties = Property::onlyTrashed()->get();
        } else {
            $properties = Property::all();
        }

        return view('admin.properties.index_tabla', compact('properties'));
    }

    /**
     * Show the form for creating new Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        //$tipos = PropertyType::all()->pluck('tipo', 'id');
        $tipos = PropertyType::whereIn('id',[1,2])->pluck('tipo', 'id');

        return view('admin.properties.create', compact('tipos'));
    }

    /**
     * Store a newly created Property in storage.
     *
     * @param  \App\Http\Requests\StorePropertiesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertiesRequest $request)
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $property = Property::create($request->all() + ['user_id' => auth()->user()->id]);
       
        return redirect()->route('admin.properties.index')
        ->with('flash','Propiedad guardada correctamente');
    }


    /**
     * Show the form for editing Property.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        $property = Property::findOrFail($id);
        $tipos = PropertyType::whereIn('id',[1,2])->pluck('tipo', 'id');

        return view('admin.properties.edit', compact('property','tipos'));
    }

    /**
     * Update Property in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertiesRequest $request, $id)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $property = Property::findOrFail($id);
        $property->update($request->all());
        $propietarios = \App\User::where('property_id', $id)->where('role_id','=',2)->where('deleted_at',NULL)->get();
        $documents = \App\Document::where('property_id', $id)->get();
        $unidades = PropertySub::where('id_property', $id)->where('deleted_at',NULL)->get();
        $facturas     = \App\PropertiesFacturas::where('id_property', $id)->where('deleted_at',NULL)->get();
        $property  = Property::findOrFail($id);
        $seguros  = PropertiesSeguros::where('id_property', $id)->where('deleted_at',NULL)->get();
        $inquilinos  = \App\User::where('property_id', $id)->where('role_id','!=','1')->where('deleted_at',NULL)->get();

        return view('admin.properties.show', compact('propietarios','documents','unidades','facturas','property','seguros','inquilinos'));

    }


    /**
     * Display Property.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // if (! Gate::allows('property_view')) {
       //     return abort(401);
        //}

        $propietarios = \App\User::where('property_id', $id)->where('role_id','=',2)->where('deleted_at',NULL)->get();
        $documents = \App\Document::where('property_id', $id)->get();
        $unidades = PropertySub::where('id_property', $id)->where('deleted_at',NULL)->get();
        $facturas     = \App\PropertiesFacturas::where('id_property', $id)->where('deleted_at',NULL)->get();
        $property  = Property::findOrFail($id);
        $seguros  = PropertiesSeguros::where('id_property', $id)->where('deleted_at',NULL)->get();
        $inquilinos  = \App\User::where('property_id', $id)->where('role_id','!=','1')->where('deleted_at',NULL)->get();

        return view('admin.properties.show', compact('propietarios','documents','unidades','facturas','property','seguros','inquilinos'));
    }


    /**
     * Remove Property from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties.index');
    }

    /**
     * Delete all selected Property at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Property::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Property from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        $property = Property::onlyTrashed()->findOrFail($id);
        $property->restore();

        return redirect()->route('admin.properties.index');
    }

    /**
     * Permanently delete Property from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('property_delete')) {
            return abort(401);
        }

        $property = Property::onlyTrashed()->findOrFail($id);
        $property->forceDelete();

        return redirect()->route('admin.properties.index');
    }
}

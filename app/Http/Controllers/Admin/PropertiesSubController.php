<?php

namespace App\Http\Controllers\Admin;

use App\PropertySub;
use App\PropertySubCanon;
use App\Property;
use App\PropertyType;
use App\PropertiesSeguros;
use App\SystemParams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertiesRequest;
use App\Http\Requests\Admin\UpdatePropertiesRequest;
use App\Http\Requests\Admin\UpdatePropertiesSubRequest;
use App\Http\Requests\Admin\StorePropertiesSubRequest;
use App\Http\Requests\Admin\StorePropertiesSubCanonRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use DB;


class PropertiesSubController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (! Gate::allows('property_access')) {
            return abort(401);
        }*/

        if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
            //$properties = Property::onlyTrashed()->get();
            //$properties_sub = PropertySub::onlyTrashed()->get();
            $properties = PropertySub::onlyTrashed()->get();
            $porc_seguro1 = SystemParams::findOrFail(1);
            $porc_seguro=$porc_seguro1->valor;
        } else {
            //$properties = Property::all();
            //$properties_sub = PropertySub::all();
            $properties = PropertySub::all();
            $porc_seguro1 = SystemParams::findOrFail(1);
            $porc_seguro=$porc_seguro1->valor;
        }

        //return view('admin.properties_sub.index', compact('properties','properties_sub'));
        return view('admin.properties_sub.index', compact('properties','porc_seguro'));
    }

    public function unidades_consulta($id)
    {
       
        if (request('show_deleted') == 1) {
            if (! Gate::allows('property_delete')) {
                return abort(401);
            }
            $properties = PropertySub::onlyTrashed()->orderBy('nombre','ASC')->get();
            //$params = DB::table('system_params')->get();
            $porc_seguro1 = SystemParams::findOrFail(1);
            $porc_seguro=$porc_seguro1->valor;
        } else {
            $properties = PropertySub::where('id_property',$id)->orderBy('nombre','ASC')->get();
        $porc_seguro1 = SystemParams::findOrFail(1);
            $porc_seguro=$porc_seguro1->valor;
        }

          return view('admin.properties_sub.index', compact('properties','porc_seguro'));
    }

    /**
     * Show the form for creating new Property.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    //public function create(Request $request,$id_property)
    {
       /* if (! Gate::allows('property_create')) {
            return abort(401);
        }*/

        //$properties = Property::all()->pluck('name', 'id');
        $property = Property::findOrFail($id);
        //$property = Property::findOrFail($id);
        //$property;
        //$id_property=$request->$property->id;
        //$id_property=2;
        //$property=2;
        //$property=$id;
        //$property=$property->id;
        //$id=1;
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');

        //return view('admin.properties_sub.create',compact('properties','tipos'));
        return view('admin.properties_sub.create',compact('tipos','property','id'));
        //return view('admin.properties_sub.create',compact('id_property','tipos'));
        //return view('admin.properties_sub.create',compact('tipos'));
        //return view('admin.properties_sub.create',compact('tipos','properties'));
    }

    /**
     * Store a newly created Property in storage.
     *
     * @param  \App\Http\Requests\StorePropertiesRequest $request
     * @return \Illuminate\Http\Response
     */
    //public function store(StorePropertiesSubRequest $request,$id)
    public function store(StorePropertiesSubRequest $request)
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        //$property = PropertySub::create($request->all() + ['user_id' => auth()->user()->id]);
        //$property = PropertySub::create($request->all() + ['id_property' => 2]);
        //$id=$id;
         $propertysub = PropertySub::create([
            'nombre'      => $request->nombre,
            'id_property' => $request->property_id,
            //'id_property' => $id,
            'id_tipo_sub' => $request->id_tipo_sub,
            'renta'       => $request->renta,
            'metros_cuadrados'       => $request->metros_cuadrados,
            'numero_banos'       => $request->numero_banos,
            'numero_cocinas'       => $request->numero_cocinas,
            'numero_parqueaderos'       => $request->numero_parqueaderos,
            'observaciones'       => $request->observaciones,
        ]);

        return redirect()->route('admin.properties.index')
        ->with('flash','Unidad creada correctamente');
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

        $property = PropertySub::findOrFail($id);
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');

        return view('admin.properties_sub.edit', compact('property','tipos'));
    }

    /**
     * Update Property in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertiesSubRequest $request, $id)
    {
        if (! Gate::allows('property_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);
        $property = PropertySub::findOrFail($id);
        $property->update($request->all());

        //return redirect()->route('admin.properties_sub.index');

        $documents = \App\Document::where('property_id', $id)->get();
        $canones = \App\PropertySubCanon::where('id_property_sub', $id)->get();
        $notes     = \App\Note::where('property_id', $id)->get();
        $property  = PropertySub::findOrFail($id);
        $seguro  = PropertiesSeguros::where('id_property_sub', $id)->first();
        $seguros  = PropertiesSeguros::where('id_property_sub', $id)->get();

        return view('admin.properties_sub.show', compact('property','seguros','seguro','canones'));
    }


    /**
     * Display Property.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('property_view')) {
            return abort(401);
        }

        $documents = \App\Document::where('property_id', $id)->get();
        $canones = \App\PropertySubCanon::where('id_property_sub', $id)->get();
        $notes     = \App\Note::where('property_id', $id)->get();
        $property  = PropertySub::findOrFail($id);
        $seguro  = PropertiesSeguros::where('id_property_sub', $id)->first();
        $seguros  = PropertiesSeguros::where('id_property_sub', $id)->get();

        return view('admin.properties_sub.show', compact('property','seguros','seguro','canones'));
    }


    /**
     * Remove Property from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('property_sub_delete')) {
            return abort(401);
        }

        $property = PropertySub::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties_sub.index');
    }

    /**
     * Delete all selected Property at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('property_sub_delete')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = PropertySub::whereIn('id', $request->input('ids'))->get();

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
        if (! Gate::allows('property_sub_delete')) {
            return abort(401);
        }

        $property = PropertySub::onlyTrashed()->findOrFail($id);
        $property->restore();

        return redirect()->route('admin.properties_sub.index');
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

        $property = PropertySub::onlyTrashed()->findOrFail($id);
        $property->forceDelete();

        return redirect()->route('admin.properties_sub.index');
    }


     public function store_nuevo_canon(StorePropertiesSubCanonRequest $request)
    {
        if (! Gate::allows('property_create')) {
            return abort(401);
        }

        $propertysubcanon = PropertySubCanon::create([
            'id_tenant'             => $request->id_tenant_canon,
            'id_property_sub'       => $request->id_property_sub,
            'nuevo_canon'           => $request->nuevo_canon,
            'fecha_cambio'          => $request->fecha_cambio,
            'observaciones'         => $request->observaciones,
        ]);

        //$documents = \App\Document::where('property_id', $id)->get();
        $canones = \App\PropertySubCanon::where('id_property_sub', $propertysubcanon->id_property_sub)->get();
        $notes     = \App\Note::where('property_id', $propertysubcanon->id_property_sub)->get();
        $property  = PropertySub::findOrFail($propertysubcanon->id_property_sub);
        $seguro  = PropertiesSeguros::where('id_property_sub', $propertysubcanon->id_property_sub)->first();
        $seguros  = PropertiesSeguros::where('id_property_sub', $propertysubcanon->id_property_sub)->get();

        return view('admin.properties_sub.show', compact('property','seguros','seguro','canones'))
        ->with('flash','Cambio de Canon registrado correctamente');
    }

}

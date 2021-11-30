<?php

namespace App\Http\Controllers\Admin;

//use App\PropertiesFacturas;
//use App\PropertiesPagos;
use App\Property;
use App\PropertySub;
//use App\Documents;
use App\PropertiesSeguros;
use App\SystemParams;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePropertiesSegurosRequest;
use App\Http\Requests\Admin\UpdateSystemParamsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Carbon\Carbon;

class SystemParamsController extends Controller
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
            $params = SystemParams::onlyTrashed()->get();
            Carbon::setLocale('es');
            $zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');
        } else {
            $params = SystemParams::all();
            Carbon::setLocale('es');
            $zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');
        }

        return view('admin.system_params.index', compact('params','zona_horaria','hora','mes','zh'));
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

        //$request  = $this->saveFiles($request);
        //$document = Document::create($request->all());

        $seguro = PropertiesSeguros::create($request->all());

        //Actualizar estado factura//
        /*$data=$request->all();
        $id_factura=$data['id_factura'];
        $factura = PropertiesFacturas::findOrFail($id_factura);
        $factura->id_estado = 2;
        $factura->save();*/
        //Actualizar estado factura//


        $asunto="Nuevo Seguro ColHouse";
     //   $data=$request->all();
        /*$pago = PropertiesPagos::create*/
        /*([
            'id_factura'  => $request->factura_id,
            'id_tenant' => $request->id_tenant,
            'id_property' => $request->id_property,
            'id_property_sub' => $request->id_property_sub,
            'valor' => $request->valor,
        ]);*/

 
        //$factura->update($id_factura_existe->all());
        /*$id_tenant=$data['id_tenant'];
        $id_property=$data['id_property'];
        $id_property_sub=$data['id_property_sub'];
        $valor=$data['valor'];



        $data = array(
            'id_factura'  =>    $id_factura,
            'id_tenant' =>      $id_tenant,
            'id_property' =>    $id_property,
            'id_property_sub' => $id_property_sub,
            'valor' => $valor,);

          Mail::send('correo.plantilla_pago_creado', $data, function ($message) use ($asunto,$id_factura,$id_tenant,$id_property,$id_property_sub,$valor){//,$email_usuario) {
        $message->from('ricaza81@gmail.com', 'ColHouse');
        $message->to('ricaza81@gmail.com')
        //->cc('laurazambranoduran.abogada@gmail.com')
        ->subject($asunto);});*/
        //return redirect()->route('admin.properties_facturas.index')
         

        return redirect()->route('admin.properties.index')
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
        $parametro   = SystemParams::findOrFail($id);

        return view('admin.system_params.edit', compact('parametro'));
    }

    /**
     * Update Seguro in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertiesSegurosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSystemParamsRequest $request, $id)
    {
       if (! Gate::allows('properties_seguros_edit')) {
            return abort(401);
        }

        //$request  = $this->saveFiles($request);*/
        $parametro = SystemParams::findOrFail($id);
        $parametro->update($request->all());


        return redirect()->route('admin.system_params.index');
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

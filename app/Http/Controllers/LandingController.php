<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\PropertyCiudad;
use App\PropertySub;
use App\User;
use App\FormContacto;
use App\FormPublicar;
use App\PropertyType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\Admin\StoreFormContactRequest;
use App\Http\Requests\Landing\StoreFormPublicarRequest;
use DB;
use App\MessengerTopic;

class LandingController extends Controller
{
  use FileUploadTrait;
       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {
        $properties = PropertySub::where('deleted_at',NULL)->get();
        //$properties_slider = PropertySub::where('id_tenant','=','')->get();
        //$properties_slider = $properties->cuenta_inquilinos == 0
        $properties_slider = PropertySub::where('deleted_at',NULL)->latest()->take(1)->get();
        // $properties_slider = PropertySub::all();
         $actual=0;
         foreach($properties_slider as $unidad){       
               $unidad=PropertySub::findOrFail($unidad->id);
               $inquilinos=$unidad->numero_inquilinos($unidad->id);
               if ($inquilinos=0);{
                $actual++;
                }
               //$actual+=($unidad->id);
               $actual=$actual;
         }
         $tenants=User::where('role_id','!=',1)->get();
         $cuenta_tenants=count($tenants);
         $disponibles=count($properties)-$cuenta_tenants;
         //return ($actual);
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');

        return view('landing.index',compact('properties','disponibles','properties_slider','actual','tipos','ciudades'));
    }

     /**
     * Show the form for creating new Contacto.
     *
     * @return \Illuminate\Http\Response
     */
     public function contacto($id)
    {
        $unidad=PropertySub::findOrFail($id);
        //$unidad=76;
        //$unidad= DB::table('properties_sub')->where('id','=',$id)->pluck('nombre')->get();
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');
         return view('landing.contacto',compact('tipos','unidad','ciudades'));
    }

     public function contacto2()
    {
      


        //$unidad=PropertySub::findOrFail($id);
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');
         return view('landing.contacto2',compact('tipos','ciudades'));
    }

       public function Publicar() {
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');
         return view('landing.publicar',compact('tipos','ciudades'));
    }

    public function busqueda(Request $request)
{
     $input = $request->all();
     //$id_tipo_sub = $input->id_tipo_sub;
     $id_tipo_sub = 3;

    // $properties = PropertySub::all();
     $properties_slider = PropertySub::latest()->take(14)->get();
     $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');

   // if($request->get('busqueda')){
        /*$properties = PropertySub::where("id_tipo_sub", "LIKE", "%{$request->get('id_tipo_sub')}%")
            ->paginate(5);
         $properties_slider = PropertySub::where("id_tipo_sub", "LIKE", "%{$request->get('id_tipo_sub')}%")
            ->paginate(5);*/
          $properties = PropertySub::where("id_tipo_sub", "LIKE", $id_tipo_sub)->get();
            //->paginate(5);
         $properties_slider = PropertySub::where("id_tipo_sub", "LIKE", $id_tipo_sub)->get();
            //->paginate(5);
     // return view('NOMBRE_VISTA')->with('buscar', $noticias);
         $properties_slider = PropertySub::where('deleted_at',NULL)->latest()->take(1)->get();
   $tenants=User::where('role_id','!=',1)->get();
   $cuenta_tenants=count($tenants);
   $disponibles=count($properties)-$cuenta_tenants;
             return view('landing.index',compact('properties','properties_slider','tipos','ciudades','disponibles'));
  //  }
    //else{
    //  $noticias = Noticia::paginate(5);
    //}

    // return response($noticias);
     // return view('landing.index',compact('properties','properties_slider','tipos','ciudades'));
}


         public function store(StoreFormContactRequest $request)
    {
       
        $contacto = FormContacto::create($request->all());
        //return redirect()->route('admin.messenger.index');
        $id_unidad=$contacto->id_property_sub;
        $unidad=PropertySub::findOrFail($id_unidad);
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');
        $flash='Gracias por tu mensaje, en menos de 24 horas te contactaremos';
        return view('landing.contacto',compact('tipos','unidad','ciudades','contacto'))
        ->with('flash',$flash);
    }

        /*   public function storepublicar(StoreFormPublicarRequest $request)
    {
            
               FormPublicar::create([
                    'content'     => $request->input('content'),

    }*/

    /*  public function storepublicar()
    {
        /*if (! Gate::allows('property_create')) {
            return abort(401);
        }*/

        //$request  = $this->saveFiles($request);
        //$property = PropertySub::create($request->all() + ['user_id' => auth()->user()->id]);
        //$property = PropertySub::create($request->all() + ['id_property' => 2]);

         /*$propertysub = PropertySub::create([
            'nombre'      => $request->nombre,
            'id_property' => 1,
            'id_tipo_sub' => $request->id_tipo_sub,
            'renta'       => $request->renta,
            'metros_cuadrados'       => $request->metros_cuadrados,
            'numero_banos'       => $request->numero_banos,
            'numero_cocinas'       => $request->numero_cocinas,
            'numero_parqueaderos'       => $request->numero_parqueaderos,
            'observaciones'       => $request->observaciones,
        ]);*/

       // return redirect()->route('landing.index')
       // ->with('flash','Unidad creada correctamente');

    //}

      public function storepublicar(Request $request)

        {
         $data=$request->all();
         $request  = $this->saveFiles($request);
         $unidad= new FormPublicar;
         //$unidad= new PropertySub;
         $unidad->nombre                =  $data["nombre"];
         $unidad->id_tipo_sub           = $request->id_tipo_sub;
         $unidad->renta                 = $request->renta;
         $unidad->metros_cuadrados      = $request->metros_cuadrados;
         $unidad->numero_banos          = $request->numero_banos;
         $unidad->numero_cocinas        = $request->numero_cocinas;
         $unidad->numero_parqueaderos   = $request->numero_parqueaderos;
         $unidad->observaciones         = $request->observaciones;
         //$unidad->photo = $request->file('photo');
         $unidad->photo = $request->photo;

         $unidad->save();
        

        $ciudades = PropertyCiudad::all()->pluck('ciudad');
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
       
         //return redirect()->route('landing.respuestapublicacion')
         return view("landing.respuestapublicacion")
        ->with('flash','Unidad creada correctamente')
        ->with('unidad',$unidad)
        ->with('tipos',$tipos)
        ->with('ciudades',$ciudades);

    }

        public function respuestapublicacion($id) {
        //$unidad=PropertySub::findOrFail($id);
        //$id=53;
        $unidad=PropertySub::findOrFail($id);
        $tipos = PropertyType::whereIn('id',[3,4,5,6])->pluck('tipo', 'id');
        $ciudades = PropertyCiudad::all()->pluck('ciudad');
         return view('landing.respuestapublicacion',compact('tipos','ciudades','unidad'));
    }

    

}

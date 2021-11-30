<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\Property;
use App\User;
use App\Role;
use App\Property;
use App\PropertySubCanon;
use App\PropertyType;
use App\PropertiesSeguros;
use App\PropertiesFacturas;
use App\PropertyCiudad;
use DB;
use Carbon\Carbon;

/**
 * Class Property
 *
 * @package App
 * @property string $nombre
 //* @property string $address
 //* @property string $photo
*/
class PropertySub extends Model 
{
    use SoftDeletes;

  

    protected $table = 'properties_sub';

    protected $fillable = ['nombre', 'id_property','id_tipo_sub','id_tenant','renta','metros_cuadrados','numero_banos','numero_cocinas','numero_parqueaderos','porc_comision','observaciones','deleted_at'];

    public function propiedad()
      {
        $result=$this->belongsTo('App\Property', 'id_property', 'id');
        return $result;
      }
    /*public function ciudad()
      {
        $result=$this->belongsTo('App\PropertyCiudad', 'id_ciudad', 'id');
        return $result;
      }*/

 /*    public function propiedad()
     {
      return $this->belongsTo(Property::class, 'id_property');
      $result=Property::where("id","=",$property->id_property)->get();
         return count($result);
     }
*/
/*         public function propiedad($id)
     {
      //return $this->belongsTo(Property::class, 'id_property');
      $result=Property::where("id","=",$id)->get();
         //return count($result);
         return ($result);
     }
*/
         public function name_propiedad($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=DB::table('properties')->where('id','=',$id)->pluck('name');
         return ($resul);
      }

      public function fecha_inicio_inquilino($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       
        //$fecha_actual=Carbon::now();
        $fecha_inicio_contrato= DB::table('users')->where('property_sub_id','=',$id)->pluck('created_at')->first();
      
         return ($fecha_inicio_contrato);
      }

       public function fecha_fin_inquilino($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       
      
        $fecha_fin_contrato= DB::table('users')->where('property_sub_id','=',$id)->pluck('fecha_fin_contrato')->first();
       // $diferencia=$fecha_inicio_contrato->diffInDays($fecha_fin_contrato);
         return ($fecha_fin_contrato);
      }

    public function propiedad_create()
      {
        return $this->belongsTo('App\Property', 'id_property', 'id');
   
      }

   public function inquilinos()
      {
        $result=$this->belongsTo('App\User', 'id', 'property_sub_id');
        return $result;
       }

     public function tenant()
      {
       return $this->hasOne('App\User', 'id', 'id_tenant');
       }

      public function cuenta_facturas_tenant($id)
      {
      $id_tenant= DB::table('users')->where('property_sub_id','=',$id)->pluck('id')->first();
      $mes_actual=date('m');
      $facturas=DB::table('properties_facturas')->where('id_tenant','=',$id_tenant)->where('fecha_inicio','=','2021-'.$mes_actual.'-01')->get();
      return count($facturas);
       }

       public function id_tenant($id)
      {
       $id_tenant= DB::table('users')->where('property_sub_id','=',$id)->pluck('id')->last();
       return($id_tenant);
       }

     public function cuenta_inquilinos()
      {
        $result=$this->belongsTo('App\User', 'id', 'property_sub_id');
        return count($result);
       }

       public function cuenta_inquilinos2($id)
      {
        $inquilinos=DB::table('users')->where('property_sub_id','=',$id)->where('deleted_at',NULL)->get();
        return count($inquilinos);
       }

  public function inquilino_role()
      {
        return $this->belongsTo('App\User', 'id', 'property_sub_id');
        //return $result;
        //return count($result);
      }

    public function numero_inquilinos($idproperty)
      {
        $result=User::where("property_id","=",$idproperty)->get();
         return count($result);
      }

    public function tipo_propiedad_sub()
      {
        $result=$this->belongsTo('App\PropertyType', 'id_tipo_sub', 'id');
        return $result;
      }

    public function facturas()
      {
        $result=$this->hasMany('App\PropertiesFacturas', 'id_property_sub', 'id')->where('deleted_at',NULL);
        return $result;
      }

     public function facturas_vencidas($id)
      {
        $result=DB::table('properties_facturas')->where('id_property_sub','=',$id)->where('deleted_at','=',NULL)->where('id_estado','=',1)->get();
       // if (isset($result)){
        return count($result);
      }
      //}

            public function seguros_unidad(){
      return $this->hasMany('App\PropertiesSeguros', 'id_property_sub', 'id');
      }

    /*  public function seguros_unidad(){
      
         return $this->hasOne('App\PropertiesSeguros', 'id_property_sub', 'id');
      }*/

        public function numero_seguros_unidad($id){
     $resul=DB::table('properties_seguros')->where('id_property_sub','=',$id)->get();
     return count($resul);
      }

       public function detalles_seguro_unidad($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=DB::table('properties_seguros')->where('id_property_sub','=',$id)->pluck('empresa');
         return ($resul);
      }

       public function detalle_seguro()
    {
        return $this->hasMany(PropertiesSeguros::class, 'id_property_sub');
    }

      public function seguros()
      {
       
      
      return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property_sub');

      }

         public function numero_tenants($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=DB::table('users')->where('property_sub_id','=',$id)->pluck('name');
        // return ($resul);
         return count($resul);
      }

         public function seguro_unidad_detalle($id)
      {
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=PropertiesSeguros::where('id_property_sub','=',$id)->first();
         return ($resul);
      }

           public function estado_seguro_unidad($id)
      {
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=PropertiesSeguros::where('id_property_sub','=',$id)
        ->pluck('estado')
        ->first();
         return ($resul);
      }

          public function canon_unidad($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       
        //$fecha_actual=Carbon::now();
        $canon= DB::table('properties_sub_canon')->where('id_property_sub','=',$id)->pluck('nuevo_canon');
      
         return ($canon);
      }

            public function cambio_canon()
    {
        return $this->hasOne(PropertySubCanon::class, 'id_property_sub');
    }

    
    
}

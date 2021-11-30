<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PropertiesFacturasEstado;
use App\Property;
use App\PropertiesPagos;
use App\PropertiesPropietarios;
use DB;

/**
 * Class Document
 *
 * @package App
 //* @property string $property
 //* @property string $user
 //* @property string $document
 //* @property string $name
*/
class PropertiesFacturas extends Model
{
    use SoftDeletes;
   

    protected $table = 'properties_facturas';

    protected $fillable = ['id','valor','adicionales','deducciones','valor_neto','comision','fecha_corte', 'id_property', 'id_property_sub','id_tenant','fecha_inicio','id_estado','obs_adicionales','obs_deducibles'];
    
  
    
    public function property()
    {
        return $this->belongsTo(Property::class, 'id_property')->withTrashed();
    }

     public function factura_property_id($id)
    {
       $resul=DB::table('properties')->where('id','=',$id->id_property)->get()->first();
        return ($resul);
    }

      public function factura_propietario_id($id)
    {
     
       $factura=PropertiesFacturas::findOrFail($id);
       $id_propiedad=$factura->id_property;
       $propiedad=DB::table('properties')->where('id','=',$id_propiedad)->get()->first();
       $propietario=DB::table('properties_propietarios')->where('id_property','=',$propiedad->id)->pluck('nombre')->first();
      
       return ($propietario);
    }

        public function factura_adeudado_tenant($id)
    {
     
       $factura=PropertiesFacturas::findOrFail($id);
       $id_inquilino=$factura->id_tenant;
       $tenant=DB::table('users')->where('id','=',$id_inquilino)->pluck('id')->first();
       $valor_neto_vencido=DB::table('properties_facturas')->where('id_tenant','=',$tenant)->where('id_estado','=',1)->sum('valor_neto');
       $valor_pagado=DB::table('properties_pagos')->where('id_tenant','=',$tenant)->sum('valor');
       $valorvencido=$valor_neto_vencido - $valor_pagado;
      
       return ($valorvencido);
    }

       public function factura_propietario_id_cedula($id)
    {
     
       $factura=PropertiesFacturas::findOrFail($id);
       $id_propiedad=$factura->id_property;
       $propiedad=DB::table('properties')->where('id','=',$id_propiedad)->get()->first();
       $propietario=DB::table('properties_propietarios')->where('id_property','=',$propiedad->id)->pluck('cedula')->first();
      
       return ($propietario);
    }

     public function property_sub()
    {
        return $this->belongsTo(PropertySub::class, 'id_property_sub')->withTrashed();
    }
    
    public function tenant()
    {
        return $this->belongsTo(User::class, 'id_tenant');
    }

     public function estado()
    {
        return $this->belongsTo(PropertiesFacturasEstado::class, 'id_estado');
    }

      public function estado2()
    {
        return $this->belongsTo('App\PropertiesFacturasEstado', 'id', 'id_estado'); 
    }

       public function pago_valor()
    {
        return $this->belongsTo('App\PropertiesPagos', 'id', 'id_factura'); 
    }

        public function id_pago_valor($id)
    {
        $factura=PropertiesFacturas::findOrFail($id);
        $pago=DB::table('properties_pagos')->where('id_factura',$factura->id)->where('deleted_at',NULL)->pluck('id')->first();
        //$id_pago=$pago->id;
        return($pago);
    }

       public function pago_valor2()
    {
      //  return $this->belongsTo('App\PropertiesPagos', 'id', 'id_factura');
         return $this->hasMany('App\PropertiesPagos', 'id_factura', 'id');
    }

         public function saldo_factura($id)
    {
      $factura=PropertiesFacturas::findOrFail($id);
      $pagos=PropertiesPagos::where('deleted_at',NULL )->where('id_factura',$id)->sum('valor');
      $saldo=$factura->valor_neto - $pagos;
      return($saldo);
    }

    

     public function pago()
    {
        //return $this->belongsToMany(PropertiesPagos::class, 'id_factura');
        //return $this->hasOne('App\PropertiesPagos', 'id', 'id_factura');
        return $this->belongsTo(PropertiesPagos::class);
    }

     public function pago3($id)
    {
        //return $this->belongsToMany(PropertiesPagos::class, 'id_factura');
        //return $this->hasOne('App\PropertiesPagos', 'id', 'id_factura');
       $resul=DB::table('properties_pagos')->where('id_factura','=',$id)->sum('valor');
        return ($resul);
    }

       public function pago4($id)
    {
        //return $this->belongsToMany(PropertiesPagos::class, 'id_factura');
        //return $this->hasOne('App\PropertiesPagos', 'id', 'id_factura');
       return DB::table('properties_pagos')->where('id_factura','=',$id)->pluck('id');
       // return ($resul);
    }

    public function pago2($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_pagos')->where('id_factura','=',$id)->sum('valor');
        return ($resul);
    }

      public function pago_informe($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_pagos')->where('id_factura','=',$id)->get()->first();
        return ($resul);
    }
    
}

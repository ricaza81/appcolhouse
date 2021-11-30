<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
//use App\PropertyOwner;
use App\Role;
use App\PropertyType;
use App\PropertySub;
use App\PropertiesFacturas;
use App\PropertiesSeguros;
use App\PropertiesPropietarios;
use DB;
use Carbon\Carbon;
use Hash;

/**
 * Class Property
 *
 * @package App
 * @property string $name
 * @property string $address
 * @property string $photo
*/
class Property extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'photo', 'user_id','id_tipo','id_seguro','id_pais','id_ciudad'];

    public function inquilinos()
      {
      return $this->belongsTo('App\User', 'id', 'property_id')->where('role_id','!=',1); 
      }

      /* public function propietarios()
      {
        $result=$this->hasMany('App\PropertyOwner', 'id_property', 'id');
        return $result;
      
      }*/

      public function cuenta_inquilinos()
      {
      $result=belongsTo('App\User', 'id', 'property_id')->where('role_id','!=',1)->get();
      return count($result);
      }

       public function count_inquilinos($id)
      {
      $result=DB::table('Users')->where('property_sub_id','=',$id->unidades->id)->get();
      return count($result);
      }

        public function count_propietarios($id)
      {
      $result=DB::table('properties_propietarios')->where('id_property','=',$id)->get();
      return count($result);
      }

        public function propietario()
      {
     //return $this->belongsTo('App\PropertiesPropietarios', 'id_property', 'id_property');
      return $this->hasMany('App\PropertiesPropietarios', 'id_property', 'id')->first();
      }

       public function unidades()
      {
       
        return $this->belongsTo('App\PropertySub', 'id', 'id_property');
    
      }

        public function propietarios()
      {
        $result=$this->hasMany('App\PropertiesPropietarios', 'id_property', 'id')->get();
        //$result=$this->hasMany('App\User', 'property_id', 'id')->where('role_id','=',2)->pluck('name')->get();
        return count($result);
      
      }

         public function propietarios2($id)
      {
       
        $resul=DB::table('properties_propietarios')->where('id_property','=',$id)->get()->first();
        return ($resul);
      
      }

     

      public function ciudad()
      {
       
        return $this->belongsTo('App\PropertyCiudad', 'id_ciudad', 'id');
    
      }

    /*     public function seguro_ppal($id)
      {
       
        //return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property');
        return $this->DB::table('properties_seguros')->where('id_property', $id)->get();
    
      }

           public function seguro_ppal_cuenta($id)
      {
       
        //return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property');
        return $this->DB::table('properties_seguros')
        ->where('id_property', $id)->count();
    
      }
*/
       public function seguros()
      {
       
      
      return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property')->where('deleted_at','=',NULL)->where('estado',1);

      }

       public function detalles_seguro($id)
      {
       
      //$property=Property::findOrFail($id);
      $seguro=PropertiesSeguros::where('id_property','=',$id)->first();
      return($seguro);
      }


             public function seguros2()
      {
       
      
      return $this->hasMany(PropertiesSeguros::class,'id_property');
      
      }

        public function cuenta_seguros()
      {
       
        //return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property');
        $resul=DB::table('properties_seguros')->where('id_property','=',$id)->count();
        return ($resul);
    
      }

       public function unidad()
      {
     return $this->hasMany(PropertySub::class, 'id_property');
      }

       public function tipo_propiedad()
      {
        $result=$this->belongsTo('App\PropertyType', 'id_tipo', 'id');
        return $result;
      }

   public function facturas()
      {
        return $this->belongsTo('App\PropertiesFacturas', 'id', 'id_property');
   
      }

    public function factura()
      {
       return $this->hasOne('App\PropertiesFacturas', 'id_property', 'id');
   
      }

    public function valor_vencido($id)
  
{
     $fecha=date('Y-m-d');
     //$valor_neto_vencido=DB::table('properties_facturas')->where('id_property','=',$id)->where('fecha_corte','<=',$fecha)->sum('valor_neto');
     $valor_neto_vencido=DB::table('properties_facturas')->where('id_property','=',$id)->where('deleted_at',NULL)->sum('valor_neto');
     $valor_pagado=DB::table('properties_pagos')->where('id_property','=',$id)->where('deleted_at',NULL)->sum('valor');
     $valorvencido=$valor_neto_vencido - $valor_pagado;
     //$valorvencido=$valor_pagado;
     return ($valorvencido);
}

    public function valor_recaudo($id)
  
{
     $fecha=date('Y-m-d');
     $valor_recaudo=DB::table('properties_facturas')->where('id_property','=',$id)->where('fecha_corte','>',$fecha)->sum('valor_neto');
     $valor_pagado=DB::table('properties_pagos')->where('id_property','=',$id)->sum('valor');
     $valorrecaudo=$valor_recaudo - $valor_pagado;
     return ($valorrecaudo);
}

    public function facturas_valor($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_facturas')->where('id_property','=',$id)->sum('valor_neto');
        return ($resul);
    }

     public function costo_seguros($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        // return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property')->where('deleted_at','=',NULL);
        $resul=DB::table('properties_seguros')->where('id_property','=',$id)->where('deleted_at','=',NULL)->sum('valor');
        return ($resul);
    }

      public function comisiones($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $pagos=DB::table('properties_pagos')->where('id_property','=',$id)->sum('valor');
        $property=Property::findOrFail($id);
        //$propietario=PropertiesPropietarios::find($property->id);
        $propiedades= Property::select('id')->get();
        //$propietarios= PropertiesPropietarios::all()->pluck('id_property');
        //$propietario=PropertiesPropietarios::findOrFail($id_propietario);
        //$porccomision=$propietario->porc_comision*100;
        //$porc_comision=$propietario->porc_comision;
        //$administracion=$pagos*$porccomision;
        $administracion=$pagos;
        //return PropertiesPropietarios::whereIn('id_property', $propiedades->first())->select('porc_comision')->get();
        //return PropertiesPropietarios::whereIn('id_property', $propiedades->first()->select('porc_comision')->get())->get();

        $porccomision=PropertiesPropietarios::whereIn('id_property', $propiedades->first())->pluck('porc_comision');//->get('porc_comision');
        //$porccomision=Property::whereIn('id', $propietarios->first())->pluck('porc_comision');//->get('porc_comision');
        $porc=str_replace(']', '', str_replace('[','',$porccomision));
        //$administracion=$pagos*$porc/100;

        $administracion=($porc);

        return ($administracion);
    }

       public function comisiones_mes($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $fecha=date('Y-m-d');
        $fecha1=date('2021-6-20');
        $fecha2=date('2021-7-20');
        //$resul=DB::table('properties_facturas')->where('id_property','=',$id)
        //->where('created_at','>=',$fecha)->where('created_at','<=',$fecha)->sum('comision');
         $resul=DB::table('properties_facturas')->where('id_property','=',$id)->sum('comision');
        return ($resul);
    }

    public function facturas_pagadas_propiedad($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_pagos')->where('id_property','=',$id)->where('deleted_at','=',NULL)->sum('valor');
        return ($resul);
    }

     public function facturas_pagadas_propiedad_fechas($id,$fecha_inicio_informe,$fecha_fin_informe)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_pagos')->where('id_property','=',$id)->where('deleted_at','=',NULL)->where('fecha_pago','>=',$fecha_inicio_informe)->where('fecha_pago','<=',$fecha_fin_informe)->sum('valor');
        return ($resul);
    }

     public function valor_total_arrendamiento($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $unidades=DB::table('properties_sub')->where('id_property','=',$id)->where('deleted_at','=',NULL);

        if (isset($unidades)) {
            $resul = DB::table('properties_sub')->where('id_property','=',$id)->where('deleted_at','=',NULL)->sum('renta');
        }

        return ($resul);
    }

      public function valor_ocupacion_actual($id)
    {
       
        $result=DB::table('users')->where('property_id','=',$id)->where('role_id','=',3)->where('deleted_at',NULL)->pluck('property_sub_id');
        
        if (isset($result)) {
        $actual=0;
        foreach($result as $resul){       
               $unidad=PropertySub::findOrFail($resul);
                $actual+=($unidad->renta);
         } }
         return ($actual);
    }

       public function unidades_facturacion()
      {
       
        return $this->belongsTo('App\User', 'id', 'property_id')->where('role_id','=',3)->sum('renta');
    
      }

   /*  public function unidades($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_sub')->where('id_property','=',$id)->sum('valor');
        return ($resul);
    }*/

       public function cant_unidades($id)
    {
        //return $this->hasMany(PropertiesFacturas::class,'$id');
        $resul=DB::table('properties_sub')->where('id_property','=',$id)->count();
        return ($resul);
    }

        public function valor_deducciones_fechas($id,$fecha_inicio_informe,$fecha_fin_informe)
  
{
     $fecha=date('Y-m-d');
     $propietario=DB::table('properties_propietarios')->where('id_property','=',$id)->get()->first();
     
     //$propiedad=DB::table('properties')->where('id_property','=',$id)->get()->first();
   
     //$id_propietario=DB::table('properties_propietarios')->where('id_property','=',$propiedad->id)->get()->first();
    
     //$tenant=DB::table('users')->where('id','=',$id_inquilino)->get()->first();
     //$id_tenant=$tenant->id;
     $valor_deducciones=DB::table('properties_propietarios_deducciones')->where('deleted_at','=', NULL)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->where('id_propietario','=',$propietario->id)->sum('valor');  
     return ($valor_deducciones);
}
    
    
    
}

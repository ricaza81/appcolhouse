<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Property;
use App\PropertiesFacturas;
use App\PropertiesSeguros;
use Hash;

/**
 * Class Role
 *
 * @package App
 * @property string $estado
*/
class PropertiesPropietarios extends Model
{

    use SoftDeletes;

    protected $table = 'properties_propietarios';

    protected $fillable = ['id_property','nombre','cedula','phone','email','direccion','porc_comision','observaciones'];

    public function factura()
      {       
        return $this->belongsTo('App\PropertiesFacturas', 'id_factura', 'id');    
      }

    public function propiedad()
      {       
        return $this->belongsTo('App\Property', 'id_property', 'id');    
      }

     public function unidad_seguro()
      {       
        return $this->belongsTo('App\PropertySub', 'id_property_sub', 'id');    
      }

     public function tenant()
      {       
        return $this->belongsTo('App\User', 'id_tenant', 'id');    
      }

        public function seguros_unidad()
      {
       
      
      return $this->belongsTo('App\PropertiesSeguros', 'id', 'id_property');

      }

      public function propiedad2()
      {
       return $this->hasOne('App\PropertiesPropietarios', 'id_property', 'id');
   
      }

      public function propiedad3()
    {
        return $this->belongsToMany(Properties::class, 'id_property');
    }

        public function valor_deducciones($id)
  
{
     $fecha=date('Y-m-d');
     $propiedad=DB::table('properties')->where('id_property','=',$id)->get()->first();
   
     $id_propietario=DB::table('properties_propietarios')->where('id_property','=',$propiedad->id)->get()->first();
    
     //$tenant=DB::table('users')->where('id','=',$id_inquilino)->get()->first();
     //$id_tenant=$tenant->id;
     $valor_deducciones=DB::table('properties_propietarios_deducciones')->where('deleted_at','=', NULL)->where('id_propietario','=',$id_propietario->id)->sum('valor');  
     return ($valor_deducciones);
}
  
    
    
    /*public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }*/
    
}

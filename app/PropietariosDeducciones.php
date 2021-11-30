<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Property;
use App\PropertiesFacturas;
use App\PropertiesSeguros;

/**
 * Class Role
 *
 * @package App
 * @property string $estado
*/
class PropietariosDeducciones extends Model
{

    use SoftDeletes;

    protected $table = 'properties_propietarios_deducciones';

    protected $fillable = ['id_propietario','fecha_deduccion','valor','observaciones'];

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
  
    
    
    /*public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }*/
    
}

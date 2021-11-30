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
class SystemParams extends Model
{

    use SoftDeletes;

    protected $table = 'system_params';

    protected $fillable = ['parametro','valor'];

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
  
    
    
    /*public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }*/
    
}

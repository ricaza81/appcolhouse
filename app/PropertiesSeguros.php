<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Property;
use App\PropertiesFacturas;
use App\PropertiesSeguros;
use Carbon\Carbon;

/**
 * Class Role
 *
 * @package App
 * @property string $estado
*/
class PropertiesSeguros extends Model
{

    use SoftDeletes;

    protected $table = 'properties_seguros';

    protected $fillable = ['id_property','id_property_sub','estado','fecha_inicio','fecha_fin','valor','cobertura','empresa','observaciones'];

     protected $dates = [
        'fecha_inicio',
        'fecha_fin',
        'created_at',
    ];

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

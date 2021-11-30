<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Property;
use App\PropertiesFacturas;

/**
 * Class PropertiesPagos
 *
 * @package App
 * @property string $estado
*/
class PropertiesPagos extends Model
{

    use SoftDeletes;

    protected $table = 'properties_pagos';

    protected $fillable = ['id_factura','id_tenant','id_property','id_property_sub','valor','fecha_pago','observaciones'];

    public function factura()
      {       
        return $this->hasOne('App\PropertiesFacturas', 'id', 'id_factura')->where('deleted_at',NULL);    
      }

    public function propiedad()
      {       
        return $this->belongsTo('App\Property', 'id_property', 'id');    
      }

     public function unidad()
      {       
        return $this->belongsTo('App\PropertySub', 'id_property_sub', 'id');    
      }

     public function tenant()
      {       
        return $this->belongsTo('App\User', 'id_tenant', 'id');    
      }
    
}

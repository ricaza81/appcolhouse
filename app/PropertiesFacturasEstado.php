<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $estado
*/
class PropertiesFacturasEstado extends Model
{
    protected $table = 'properties_facturas_estado';

    protected $fillable = ['estado'];
    
    
    
    /*public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }*/
    
}

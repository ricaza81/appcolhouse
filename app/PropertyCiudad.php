<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $pais
*/
class PropertyCiudad extends Model
{
    protected $table = 'properties_ciudades';

    protected $fillable = ['id_pais','ciudad'];
    
}

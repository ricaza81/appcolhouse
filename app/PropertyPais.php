<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $pais
*/
class PropertyPais extends Model
{
    protected $table = 'properties_paises';

    protected $fillable = ['pais'];
    
}

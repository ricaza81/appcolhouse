<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $tipo
*/
class PropertyType extends Model
{
    protected $table = 'properties_type';

    protected $fillable = ['tipo'];
    
}

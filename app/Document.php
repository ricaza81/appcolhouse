<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
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
 * Class Document
 *
 * @package App
 * @property string $property
 * @property string $tenant
 * @property string $document
 * @property string $name
 * @property string $document
*/
class Document extends Model
{
    use SoftDeletes;

    //protected $table = 'documents';

    protected $fillable = ['document', 'name', 'property_id','tenant_id'];
    
  /*  public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    /**
     * Set to null if empty
     * @param $input
     */
 /*   public function setPropertyIdAttribute($input)
    {
        $this->attributes['property_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
/*    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }*/
    
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
    
}

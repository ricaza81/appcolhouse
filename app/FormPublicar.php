<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PropertyType;

/**
 * Class Role
 *
 * @package App
 * @property string $pais
*/
class FormPublicar extends Model
{
    protected $table = 'form_publicar';

     protected $fillable = ['nombre', 'id_property','id_tipo_sub','id_tenant','renta','metros_cuadrados','numero_banos','numero_cocinas','numero_parqueaderos','porc_comision','observaciones','photo'];

       public function propiedad()
      {
        $result=$this->belongsTo('App\Property', 'id_property', 'id');
        return $result;
      }
        public function name_propiedad($id)
{
      //$resul=DB::table('properties')->where('id','=',$id)->latest()->first();
       

        $resul=DB::table('properties')->where('id','=',$id)->pluck('name');
         return ($resul);
      }
 public function tipo_propiedad_sub()
      {
        $result=$this->belongsTo('App\PropertyType', 'id_tipo_sub', 'id');
        return $result;
      }
    
}

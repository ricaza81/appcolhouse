<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertiesFacturasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_inicio' => 'required',
            'fecha_corte' => 'required',
            'fecha_corte' => 'after_or_equal:fecha_inicio',
            //'fecha_corte' >= 'fecha_inicio' => 'after_or_equal_fecha_corte',
            //'fecha_corte' >= 'fecha_inicio' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests\Landing;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormPublicar extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           /* 'subject'  => 'required',
            'receiver' => 'required',
            'content'  => 'required',*/
        ];
    }
}

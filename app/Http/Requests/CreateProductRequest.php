<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\ValidationServiceProvider;

class CreateProductRequest extends Request
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
            'code'=>'required|unique:products',
            'style'=>'required|max:12',
            'measure'=>'required|max:12',
        ];
    }

    public function messages ()
    {
        return [
            'code.required' => 'El campo código es requerido',
            'style.required' => 'El campo estilo es requerido',
            'measure.required' => 'El campo medida es requerido',

            'code.max' => 'El campo código no puede ser mayor a :max caracteres',
            'style.max' => 'El campo estilo no puede ser mayor a :max caracteres',
            'measure.max' => 'El campo medida no puede ser mayor a :max caracteres',

            'code.unique' => 'El código introducido ya esta registrado',
            'style.unique' => 'El estilo introducido ya esta registrado',
            'measure.unique' => 'El medida introducido ya esta registrado'
        ];
    }

}

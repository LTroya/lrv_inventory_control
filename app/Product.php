<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'style', 'measure'];

//    protected $table = 'products';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
//    public function rules()
//    {
//        return [
//            'code'=>'required|unique:products',
//            'style'=>'required|max:12',
//            'measure'=>'required|max:12',
//        ];
//    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
//    public function messages()
//    {
//        return [
//            'code.required' => 'El campo código es requerido',
//            'style.required' => 'El campo estilo es requerido',
//            'measure.required' => 'El campo medida es requerido',
//
//            'code.max' => 'El campo código no puede ser mayor a :max caracteres',
//            'style.max' => 'El campo estilo no puede ser mayor a :max caracteres',
//            'measure.max' => 'El campo medida no puede ser mayor a :max caracteres',
//
//            'code.unique' => 'El código introducido ya esta registrado',
//            'style.unique' => 'El estilo introducido ya esta registrado',
//            'measure.unique' => 'El medida introducido ya esta registrado'
//        ];
//    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoLoginRequest extends Request
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages ()
    {
        return [
            'email.required' => 'El usuario es requerido.',
            'password.required' => 'La contraseña es requerida',

            'email.email' => 'El correo electrónico ingresado no tiene el formato correcto'
        ];
    }
}

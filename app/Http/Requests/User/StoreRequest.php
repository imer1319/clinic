<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:60|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no puede tener un tamaño mayor a 255.',
            'email.required' => 'El campo correo electronico es obligatorio.',
            'email.email' => 'El campo correo electronico debe ser un formato valido.',
            'email.max' => 'El campo correo electronico no puede tener un tamaño mayor a 255.',
            'username.required' => 'El campo nombre de usuario es obligatorio.',
            'username.unique' => 'El campo nombre de usuario ya ha sido registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];
    }
}

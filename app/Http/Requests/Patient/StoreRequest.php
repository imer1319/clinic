<?php

namespace App\Http\Requests\Patient;

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
            'name' => 'required|max:60',
            'surnames' => 'required|max:150',
            'ci' => 'required|numeric',
            'celular' => 'required|numeric|min:8',
            'address' => 'required|min:5',
            'city' => 'required|min:5',
            'gender'=> 'required|in:Masculino,Femenino',
            'nacimiento' => 'required|date|date_format:Y-m-d|before:'. date("Y-m-d"),
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notas' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'surnames.required' =>  'El campo apellidos es obligatorio.',
            'ci.required' => 'El campo ci es obligatorio.',
            'ci.numeric' => 'El campo ci debe ser numerico.',
            'ci.numeric' => 'El campo ci debe ser numerico.',
            'phone.required' => 'El campo telefono es obligatorio.',
            'address.required' => 'El campo direccion es obligatorio.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El campo imagen debe ser una imagen.',
            'image.mimes' => 'El campo imagen debe ser un archivo con formato: jpeg, png, jpg, gif, svg.',
        ];
    }
}

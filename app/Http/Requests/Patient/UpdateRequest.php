<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'surnames' => 'required|max:255',
            'ci' => 'required',
            'celular' => 'required|numeric',
            'city' => 'required|min:5',
            'address' => 'required|min:5',
            'gender'=> 'required|in:Masculino,Femenino',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_historial' => 'nullable|date|date_format:Y-m-d',
            'nacimiento' => 'required|date|date_format:Y-m-d|before:'. date("Y-m-d"),
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

<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return  [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'surnames' => 'required|max:200',
            'ci' => [
                'required', 'numeric',
                Rule::unique('profiles')->ignore($this->user_id)
            ],
            'nacimiento' =>'required|date|date_format:Y-m-d|before:today',
            'celular' => 'required|numeric',
            'address' => 'required',
            'specialty_id' => 'nullable|numeric|exists:App\Models\Specialty,id',
            'gender' => 'required|in:Masculino,Femenino',
        ];
    }

    public function messages()
    {
        return [
            'surnames.required' => 'El campo apellidos es obligatorio.',
            'surnames.max' => 'El campo apellidos no puede tener un tamaño mayor a 200.',
            'ci.required' => 'El cmpo CI es obligatorio',
            'ci.numeric' => 'El CI debe ser numérico',
            'ci.unique' => 'El CI ya ha sido registrado',
            'nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'nacimiento.before' => 'La fecha de nacimiento no puede ser mayor a la fecha de hoy',
            'nacimiento.date' => 'La fecha de nacimiento debe tener un formato de fecha',
            'celular.required' => 'El numero de celular es obligatorio',
            'celular.numeric' => 'El numero de celular debe ser numerico',
            'address.required' => 'El campo dirección es obligatorio',
            'specialty_id.exists' => 'La especialidad debe estar registrada',
            'gender.required' => 'El campo género es obligatorio',
            'gender.in' => 'El campo género solo puede contener Masculino o Femenino',

        ];
    }
}

<?php

namespace App\Http\Requests\Consultation;

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
            'motivo' => 'required',
            'doctor_id' => 'required|numeric|exists:App\Models\Doctor,id',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'surnames.required' =>  'El campo apellidos es obligatorio.',
            'ci.required' => 'El campo ci es obligatorio.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El campo imagen debe ser una imagen.',
            'image.mimes' => 'El campo imagen debe ser un archivo con formato: jpeg, png, jpg, gif, svg.',
        ];
    }
}

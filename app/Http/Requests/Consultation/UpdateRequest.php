<?php

namespace App\Http\Requests\Consultation;

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
            'motivo_consulta' => 'nullable|min:4',
            'sintoma' => 'nullable|min:4',
            'doctor_id' => 'required|numeric|exists:App\Models\User,id',
            'patient_id' => 'required|numeric|exists:App\Models\User,id',
            'diagnosis' => 'nullable|min:4'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'surnames.required' =>  'El campo apellidos es obligatorio.',
        ];
    }
}

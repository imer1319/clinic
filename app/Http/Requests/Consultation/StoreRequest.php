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
            'doctor_id' => 'required|numeric|exists:App\Models\User,id',
            'patient_id' => 'required|numeric|exists:App\Models\User,id',
        ];
    }

    public function messages()
    {
        return [
            'MOTIVO.required' => 'El campo motivo es obligatorio.',
        ];
    }
}

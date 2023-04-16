<?php

namespace App\Http\Requests\PhysicalExploration;

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
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'physical_exploration_id' => 'required|numeric|exists:App\Models\PhysicalExploration,id',
            'answer' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'answer.required' => 'El campo respuesta es obligatorio.',
            'answer.min' => 'La respuesta debe tener al menos 2 caracter.',
        ];
    }
}

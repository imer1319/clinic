<?php

namespace App\Http\Requests\HistoryPatient;

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
            'answer' => 'required|min:2',
            'patient_id' => 'required|numeric|exists:App\Models\User,id',
            'history_question_id' => 'required|numeric|exists:App\Models\HistoryQuestion,id'
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

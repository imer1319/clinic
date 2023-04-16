<?php

namespace App\Http\Requests\DateHistorial;

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
            'date_historial' => 'nullable|date|date_format:Y-m-d|before_or_equal:'. date("Y-m-d"),
            'patient_id' => 'required|numeric|exists:App\Models\User,id'
        ];
    }

    public function messages()
    {
        return [
            'date_historial.date' => 'La fecha del historial debe tener un formato de fecha',
            'date_historial.before_or_equal' => 'La fecha del historial debe ser menor o igual a hoy',
        ];
    }
}

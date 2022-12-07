<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'doctor_id' => 'required|numeric|exists:App\Models\Doctor,id',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'observations' => 'required|min:10',
            'title' => 'required',
            'start' => 'required|date|after_or_equal:yesterday',
            'color' => 'required',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'subServices' => 'required',
            'total' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.required' => 'El campo doctor es obligatorio.',
            'doctor_id.numeric' => 'El campo doctor debe ser un valor numerico.',
            'doctor_id.exists' => 'El registro del doctor debe existir en la DB.',
            'patient_id.required' => 'El campo paciente es obligatorio.',
            'patient_id.numeric' => 'El campo paciente debe ser un valor numerico.',
            'patient_id.exists' => 'El registro del paciente debe existir en la DB.',
            'observations.required' => 'El campo observaciones es obligatorio.',
            'observations.min' => 'El campo observaciones debe tener al menos 10 caracteres.',
            'start.required' => 'El campo fecha es obligatorio.',
            'start.after_or_equal' => 'La fecha debe ser posterior o igual a a fecha de hoy.',
            'time_start.required' => 'El campo hora inicial es obligatorio.',
            'time_end.required' => 'El campo hora final es obligatorio.',
            'time_end.after' => 'La hora final debe ser mayor a la hora inicial.',
        ];
    }
}

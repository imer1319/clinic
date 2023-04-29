<?php

namespace App\Http\Requests\Horario;

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
        // dd($this->all());
        return [
            'morning_start' => 'required|date_format:H:i',
            'morning_end' => 'required|date_format:H:i|after:morning_start',
            'afternoon_start' => 'required|date_format:H:i|after:morning_end',
            'afternoon_end' => 'required|date_format:H:i|after:afternoon_start',
            'active' => 'boolean',
        ];
    }
}

<?php

namespace App\Http\Requests\Service;

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
            'name' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres.',
        ];
    }
}

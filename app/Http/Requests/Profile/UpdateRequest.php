<?php

namespace App\Http\Requests\Profile;

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
            'surnames' => 'required|max:255',
            'ci' => 'required',
            'nacimiento' => 'required|date',
            'celular' => 'required|numeric',
            'address' => 'required',
            'specialty_id' => 'required|numeric|exists:App\Models\Specialty,id',
            'gender'=> 'required|in:Masculino,Femenino',
            'user_id' => 'required|numeric|exists:App\Models\User,id',
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

<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'surnames' => 'required|max:255',
            'ci' => [
                'required', 'numeric',
                Rule::unique('profiles')->ignore($this->user_id)
            ],
            'nacimiento' => 'required|date',
            'celular' => 'required|numeric',
            'address' => 'required',
            'specialty_id' => 'nullable|numeric|exists:App\Models\Specialty,id',
            'gender' => 'required|in:Masculino,Femenino',
        ];
        return $rules;
    }
}

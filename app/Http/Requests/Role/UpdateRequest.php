<?php

namespace App\Http\Requests\Role;

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
        return  [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($this->route('role')->id)
            ],
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'El identificador del rol es obligatorio.',
            'name.unique' => 'Este identificador ya ha sido registrado.',
        ];
    }
}

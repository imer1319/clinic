<?php

namespace App\Http\Requests\Role;

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
        $rules = [
            'display_name' => 'required|max:10',
        ];

        if ($this->method() !== 'PUT') {
            $rules['name'] = 'required|unique:roles';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El identificador del rol es obligatorio.',
            'name.unique' => 'Este identificador ya ha sido registrado.',
            'display_name.required' => 'El nombre del rol es obligatorio.',
            'display_name.max' => 'El nombre del rol no debe tener mas de 10 caracteres.'
        ];
    }
}

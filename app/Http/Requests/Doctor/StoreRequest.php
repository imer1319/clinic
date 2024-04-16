<?php

namespace App\Http\Requests\Doctor;

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
        // dd($this->all());
        return [
            'name' => 'required|max:255',
            'surnames' => 'required|max:255',
            'ci' => 'required|unique:profiles,ci',
            'username' => 'required|unique:users,username',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nacimiento' => 'required|date',
            'celular' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'specialty_id' => 'required|numeric|exists:App\Models\Specialty,id',
            'gender'=> 'required|in:Masculino,Femenino',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'surnames.required' =>  'El campo apellidos es obligatorio.',
            'ci.required' => 'El campo ci es obligatorio.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El campo imagen debe ser una imagen.',
            'image.mimes' => 'El campo imagen debe ser un archivo con formato: jpeg, png, jpg, gif, svg.',
        ];
    }
}

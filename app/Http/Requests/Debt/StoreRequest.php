<?php

namespace App\Http\Requests\Debt;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MinTotal;

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
            'amount' => [
                'required','integer','min:1',
                new MinTotal($this->appointment->total-$this->total_debts)
            ],
            'total' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'El campo monto inicial es requerido', 
            'amount.min' => 'El campo monto no puede ser 0' 
        ];
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinTotal implements Rule
{
    public $total;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($total)
    {
        $this->total = $total;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value <= $this->total;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puede ser mayor al total de los pagos';
    }
}

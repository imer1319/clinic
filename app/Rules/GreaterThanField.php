<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThanField implements Rule
{
    protected $otherField;

    public function __construct($otherField)
    {
        $this->otherField = $otherField;
    }
    
    public function passes($attribute, $value)
    {
        $otherFieldValue = request()->input($this->otherField);
        return $value > $otherFieldValue;
    }

    public function message()
    {
        return "The :attribute must be greater than the {$this->otherField}.";
    }
}

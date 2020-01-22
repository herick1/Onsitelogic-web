<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validarFechas implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min)
    {
           $this->min = $min;
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
        $this->valor = $value;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->min;
    }
}

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
           $this->fecha_inicio = $min;
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
        return $value >= $this->fecha_inicio;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The event end date debe ser menor a la event start date";
    }
}

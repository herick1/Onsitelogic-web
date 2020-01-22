<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class validarLugar implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($parroquia)
    {
           $this->parroquia = $parroquia;
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

        $parroquia = DB::table('Lugar')->where('id',$this->parroquia)->first();

        if($parroquia)return true;
        else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The parish isn't valid";
    }
}

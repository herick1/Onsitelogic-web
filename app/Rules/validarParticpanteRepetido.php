<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class validarParticpanteRepetido implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$fecha_de_nacimiento)
    {
            $this->primer_nombre = $primer_nombre;
            $this->segundo_nombre = $segundo_nombre;
            $this->primer_apellido = $primer_apellido;
            $this->segundo_apellido = $segundo_apellido;
            $this->fecha_de_nacimiento = $fecha_de_nacimiento;

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
        
        $participante = DB::table('Participante')->where([['cedula', '=', $value],
                                                       ['pimer_nombre', '=', $this->primer_nombre],
                                                       ['segundo_nombre', '=', $this->segundo_nombre],
                                                       ['primer_apellido', '=', $this->primer_apellido],
                                                       ['segundo_apellido', '=', $this->segundo_apellido],
                                                       ['fecha_de_nacimiento', '=', $this->fecha_de_nacimiento],

        ])->first();

        if($participante)return false;
        else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "This participant already exists";
    }
}

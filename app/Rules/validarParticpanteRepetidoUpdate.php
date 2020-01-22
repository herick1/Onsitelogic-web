<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class validarParticpanteRepetidoUpdate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$fecha_de_nacimiento)
    {
            $this->id=$id;
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
        //buscamos al participante con la id que teniamos a ver si es el caso de que sea igual pero que estebien que sea igual 
        //porque como provienes de un actulaizar puede ser la misma informacion que tenias para actualizar al aprticipantes
        $participante = DB::table('Participante')->where([['id', '=', $this->id],
                                                       ['cedula', '=', $value],
                                                       ['pimer_nombre', '=', $this->primer_nombre],
                                                       ['segundo_nombre', '=', $this->segundo_nombre],
                                                       ['primer_apellido', '=', $this->primer_apellido],
                                                       ['segundo_apellido', '=', $this->segundo_apellido],
                                                       ['fecha_de_nacimiento', '=', $this->fecha_de_nacimiento],

        ])->first();

        if($participante)return true;
        else{
            //estmos en el caso de que no es igual al que se supone que deberia de ser igual por la id 
            //entonces aqui si buscamos que no sea igual a ninguno de los participantes que esten en la lista
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

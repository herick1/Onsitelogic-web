<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipanteRequest extends FormRequest
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
            'cedula' => 'required|numeric',
            'email' => 'required|email|max:200',
            'primer_nombre' => 'required|max:30',
            'segundo_nombre' => 'max:30',
            'primer_apellido' => 'required|max:60',
            'segundo_apellido' => 'required|max:60',
            'fecha_de_nacimiento' => 'date',
            'telefono' => 'required|max:30',
            'tipo' => 'max:20|in:Visitante,Exponente,Asesor,Otros',
            'parroquiaSelect' => 'required|min:1',
        ];
    }
}

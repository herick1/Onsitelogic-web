<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Nuevas validaciones
use App\Rules\validarFechas;

class EventoRequest extends FormRequest
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
            'tipo' => 'required|max:20|',
            'nombre' => 'required|max:60|',
            'cantidad_de_personas' => 'max:99999',
            'fecha_inicio' => 'date',
            'fecha_fin'  => 'date',
            'parroquiaSelect' => 'required|min:1|',
        ];
    }
    
    public function messages()
    {
        return [
            'parroquiaSelect.required' => 'The parish is required',
        ];
    }
}
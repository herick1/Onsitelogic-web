<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class LugarController extends Controller
{

    public function buscadorMunicipio(Request $request){
        $estadoID = $request->estado;
            
        $select = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where fk_Lugar = $estadoID and tipo = 'Municipio'"
        ));
        return view('lugares.selectMunicipio' , compact('select'));  
    }

    public function buscadorParroquia(Request $request){
        $municipioID = $request->municipio;
            
        $select = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where fk_Lugar = $municipioID and tipo = 'Parroquia'"
        ));
        return view('lugares.selectParroquia' , compact('select'));  
    }
}

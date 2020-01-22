<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //funcion para trar todos los mensajes
        $eventos_lista = DB::table('Evento')->get();
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        $mensajeDeexito=null;
        return view('eventos.index' , compact('eventos_lista', 'estados', 'mensajeDeexito'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        return view('eventos.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Model::unguard();
        //metodo post
        if( $request->input('parroquiaSelect') > 0) {
            DB::select('CALL sp_insert_evento(:p0, :p1, :p2, :p3, :p4, :p5)',
                    array(
                        'p0' =>  $request->input('tipo'),
                        'p1' =>  $request->input('nombre'),
                        'p2' =>  $request->input('cantidad_de_personas'),
                        'p3' =>  $request->input('fecha_inicio'),
                        'p4' =>  $request->input('fecha_fin'),
                        'p5' => $request->input('parroquiaSelect'),
            )); 
            $p0 =$request->input('tipo');
            $p1 =  $request->input('nombre');
            $p2 =  $request->input('cantidad_de_personas');
            $p3 =  $request->input('fecha_inicio');
            $p4 =  $request->input('fecha_fin');
            $p5 = $request->input('parroquiaSelect');
            //buscamos la id del evento
            $eventosID = DB::select(DB::raw("SELECT id
                                              FROM Evento
                                              WHERE tipo = '$p0' and nombre = '$p1'
                                              and cantidad_de_personas = $p2
                                              and fecha_inicio = '$p3'
                                              and fecha_fin =  '$p4'
                                              and fk_Lugar = $p5"
            ));
            foreach ($eventosID as $eventoID) {
                $id_evento=$eventoID->id;
            }
            $participantes = DB::select(DB::raw("SELECT id
                                           from Participante"
            )); 
            //insertamos al participante en toda la tabla de historial_usuario_evento
            //TODO se puede hacer directo con un trigger (revisar stored procedured en DDL)
            foreach ($participantes as $participante) {
                DB::select('CALL sp_insertar_historial(:p0, :p1, :p2)',
                    array(
                        'p0' =>  0,
                        'p1' =>  $participante->id,
                        'p2' =>  $id_evento,
                ));
            }
            $mensajeDeexito="created";
        }
        else{
            $mensajeDeexito=null;
        } 
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));    
        $eventos_lista = DB::table('Evento')->get();
        return view('eventos.index' , compact('eventos_lista', 'estados', 'mensajeDeexito'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //es un select de una id 
        $evento = DB::table('Evento')->where('id',$id)->first();

        $eventos_listas = DB::select(DB::raw("SELECT p.* , l3.nombre as parroquia, l2.nombre as municipio , l1.nombre as estado
                                        FROM Evento p, lugar l1, lugar l2, lugar l3
                                        where p.id=$id and p.fk_Lugar= l3.id and l3.fk_Lugar = l2.id and l2.fk_Lugar= l1.id"
        ));
        foreach ($eventos_listas as $eventoID) {
            $evento=$eventoID;
        }
        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //presentar formulario para actualizar mensaje
        $eventos_listas = DB::select(DB::raw("SELECT p.* , l3.id as parroquiaID , l3.nombre as parroquiaNombre,
                                        l2.id as municipioID, l2.nombre as municipioNombre, l1.id as estadoID , l1.nombre as estadoNombre
                                        FROM Evento p, lugar l1, lugar l2, lugar l3
                                        where p.id=$id and p.fk_Lugar= l3.id and l3.fk_Lugar = l2.id and l2.fk_Lugar= l1.id"
        ));
        //esto lo hago asi ya que primero lo busco pero el problema es que este evento no tiene las columnas que me faltan del lugar , es por esto que lo traigo asi 
        $eventos_lista=DB::table('Evento')->where('id',$id)->first();
        foreach ($eventos_listas as $eventoID) {
            $eventos_lista=$eventoID;
            $estadoID= $eventoID->estadoID;
            $municipioID= $eventoID->municipioID;
        }
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        $municipios = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where fk_Lugar = $estadoID and tipo = 'Municipio'"
        ));
        $parroquias = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where fk_Lugar = $municipioID and tipo = 'Municipio'"
        ));
        return view('eventos.edit', compact('eventos_lista', 'estados', 'municipios', 'parroquias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( $request->input('parroquiaSelect') > 0) {
            DB::select('CALL sp_update_evento(:p0, :p1, :p2, :p3, :p4, :p5, :p6)',
                    array(
                        'p0' => $id,
                        'p1' =>  $request->input('tipo'),
                        'p2' =>  $request->input('nombre'),
                        'p3' =>  $request->input('cantidad_de_personas'),
                        'p4' =>  $request->input('fecha_inicio'),
                        'p5' =>  $request->input('fecha_fin'),
                        'p6' => $request->input('parroquiaSelect') ,
                    ));

            $mensajeDeexito="updated";
        }
        else{
            $mensajeDeexito=null;
        }
        $eventos_lista = DB::table('Evento')->get();
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        return view('eventos.index' , compact('eventos_lista', 'estados', 'mensajeDeexito'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::select('CALL sp_delete_evento(:p0)',
                array(
                    'p0' => $id
                ));
        $eventos_lista = DB::table('Evento')->get();
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        $mensajeDeexito="deleted";
        return view('eventos.index' , compact('eventos_lista', 'estados','mensajeDeexito'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function buscador(Request $request){
        $palabra = $request->texto;
        //si es numerico lo busco por la cedula sino lo busco por los demas campos
        if(is_numeric($palabra)){
            $eventos_lista = DB::select(DB::raw("SELECT * 
                                                   FROM Evento
                                                   where id like '$palabra%'" 
            ));
        }else{
            $eventos_lista = DB::select(DB::raw("SELECT DISTINCT * 
                                                   FROM  evento
                                                   where tipo like '$palabra%' or nombre like '$palabra%'" 
            ));
        }
        return view('eventos.tabla' , compact('eventos_lista'));      
    }
}

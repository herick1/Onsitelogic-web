<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth',['except'=> ['create','store', 'index', 'show', 'edit','update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventosGet = "Seleccione un evento";
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //metodo post
        $mensaje= $request->input('Participante');       
        DB::select('CALL sp_insert_participante(:p0, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8 )',
                array(
                    'p0' =>  $request->input('cedula'),
                    'p1' =>  $request->input('email'),
                    'p2' =>  $request->input('primer_nombre'),
                    'p3' =>  $request->input('segundo_nombre'),
                    'p4' =>  $request->input('primer_apellido'),
                    'p5' => $request->input('segundo_apellido'),
                    'p6' => $request->input('fecha_de_nacimiento'),
                    'p7' => $request->input('telefono'),
                    'p8' => $request->input('tipo'),
                ));

        $id_participante=null;
        //buscamos la id del participante
        $participantesID = DB::select(DB::raw("SELECT id
                                          FROM Participante
                                          WHERE cedula = $request->input('cedula') and email = $request->input('email')
                                          and pimer_nombre = $request->input('primer_nombre') 
                                          and segundo_nombre = $request->input('segundo_nombre') 
                                          and primer_apellido =  $request->input('primer_apellido') 
                                          and segundo_apellido = $request->input('segundo_apellido')
                                          and fecha_de_nacimiento = $request->input('fecha_de_nacimiento')
                                          and telefono = $request->input('telefono')
                                          and tipo = $request->input('tipo')"
        ));
        foreach ($participantesID as $participanteID) {
            $id_participante=$participanteID->id;
        }
        //insertamos al participante en toda la tabla de historial_usuario_evento
        //TODO se puede hacer directo con un trigger (revisar stored procedured en DDL)
        foreach ($eventos as $eventoValue) {
            DB::select('CALL sp_insertar_historial(:p0, :p1, :p2)',
                array(
                    'p0' =>  0,
                    'p1' =>  $id_participante,
                    'p2' =>  $eventoValue->id,
            ));
        }
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
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
        $participante = DB::table('Participante')->where('id',$id)->first();
        return view('participantes.show', compact('participante'));
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
        $participantes_lista = DB::table('Participante')->where('id',$id)->first();
        return view('participantes.edit', compact('participantes_lista'));
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
        $mensaje= $request->input('Participante');

        DB::select('CALL sp_update_participante(:p0, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9 )',
                array(
                    'p0' =>  $id,
                    'p1' =>  $request->input('cedula'),
                    'p2' =>  $request->input('email'),
                    'p3' =>  $request->input('primer_nombre'),
                    'p4' =>  $request->input('segundo_nombre'),
                    'p5' =>  $request->input('primer_apellido'),
                    'p6' =>  $request->input('segundo_apellido'),
                    'p7' =>  $request->input('fecha_de_nacimiento'),
                    'p8' => $request->input('telefono'),
                    'p9' => $request->input('tipo'),
                ));
        //llenado de la busqueda del evento para que quede igual de como estaba antes de hacer el eliminar
        $eventosGet ="Seleccione un evento";
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::select('CALL sp_delete_participante(:p0)',
                array(
                    'p0' => $id
                ));
        //llenado de la busqueda del evento para que quede igual de como estaba antes de hacer el eliminar
        $eventosGet ="Seleccione un evento";
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function busquedaEvento($idEvento = 1) 
    {
       $eventosGets = DB::select(DB::raw("SELECT nombre
                                          FROM Evento
                                          WHERE id=$idEvento"
        ));
        $eventosGet = null;
        foreach ($eventosGets as $eventosGeValue) {
            $eventosGet=$eventosGeValue->nombre;
        }
        if(!$eventosGet) $eventosGet="Seleccione un evento";
        $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                   FROM Participante p, historial_usuario_evento h
                                                   WHERE p.id=fk_participante AND h.fk_evento=$idEvento"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function UpdateAsistencia($id, $asistencia) 
    {
        DB::select('CALL sp_update_asistencia(:p0, :p1)',
                array(
                    'p0' => $id,
                    'p1' => $asistencia

                ));
        //llenado de la busqueda del evento para que quede igual de como estaba antes de hacer click en la asistencia
       $eventosGets = DB::select(DB::raw("SELECT e.nombre
                                          FROM Evento e , historial_usuario_evento h
                                          WHERE e.id=fk_evento AND h.id = $id"
        ));
        $eventosGet = null;
        foreach ($eventosGets as $eventosGeValue) {
            $eventosGet=$eventosGeValue->nombre;
        }
        $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                   FROM Participante p, historial_usuario_evento h
                                                   WHERE p.id=fk_participante AND 
                                                   h.fk_evento in (select fk_evento from  historial_usuario_evento
                                                    where id = $id)"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'eventosGet'));
    }


    public function buscador(Request $request){
        $idEventoSeleccionado = 1;
        $palabra = $request->texto;

        $eventosGets = DB::select(DB::raw("SELECT nombre
                                          FROM Evento
                                          WHERE id = $idEventoSeleccionado"
        ));
        $eventosGet = null;
        foreach ($eventosGets as $eventosGeValue) {
            $eventosGet=$eventosGeValue->nombre;
        }
        if(!$eventosGet){
            $eventosGet="Seleccione un evento";
            $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p
                                                   where p.pimer_nombre like '%$palabra%'" 
            ));
        }else{
            $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                       FROM Participante p, historial_usuario_evento h
                                                       WHERE p.pimer_nombre like '%$palabra%' and p.id=fk_participante AND
                                                       h.fk_evento in (select fk_evento from  historial_usuario_evento
                                                    where id = $idEventoSeleccionado)" 
            ));
        }

        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        return view('participantes.tabla' , compact('participantes_lista', 'eventos', 'eventosGet'));      
    }
}

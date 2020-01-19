<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p
                                                    ORDER BY cedula"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        //esta variable solo se utiliza la veces que hay que recargar la pagina por una actualizacion, aupdate de asistencia o cuando se elimina un participante y ya se habia selecionado un evento antes
        $eventoAntesSeleccionado= null;
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'estados', 'eventoAntesSeleccionado'));
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
        return view('participantes.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ParticipanteRequest $request)
    {
        //esta variable solo se utiliza la veces que hay que recargar la pagina por una actualizacion, aupdate de asistencia o cuando se elimina un participante y ya se habia selecionado un evento antes
          

        if($request->input('parroquiaSelect')>0)
        {
            DB::select('CALL sp_insert_participante(:p0, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8 , :p9 )',
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
                        'p9' => $request->input('parroquiaSelect'),
                    ));
            //esto lo hago ya que si comparo directamente en el query me da un error
            $p0= $request->input('cedula');
            $p1 = $request->input('email');
            $p2 =  $request->input('primer_nombre');
            $p3 =  $request->input('segundo_nombre');
            $p4 =  $request->input('primer_apellido');
            $p5 = $request->input('segundo_apellido');
            $p6 = $request->input('fecha_de_nacimiento');
            $p7 = $request->input('telefono');
            $p8 = $request->input('tipo');
            $id_participante=0;
            //buscamos la id del participante
            $participantesID = DB::select(DB::raw("SELECT id
                                              FROM Participante
                                              WHERE cedula = $p0 and email = '$p1'
                                              and pimer_nombre = '$p2'
                                              and segundo_nombre = '$p3'
                                              and primer_apellido =  '$p4'
                                              and segundo_apellido = '$p5'
                                              and fecha_de_nacimiento = '$p6'
                                              and telefono = '$p7'
                                              and tipo = '$p8'"
            ));
            foreach ($participantesID as $participanteID) {
                $id_participante=$participanteID->id;
            }
            $eventos = DB::select(DB::raw("SELECT id, nombre
                                           from Evento"
            )); 
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
        }
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        )); 
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p
                                                    ORDER BY cedula"
        ));
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        $eventoAntesSeleccionado= null;
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'estados', 'eventoAntesSeleccionado'));
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

        //presentar formulario para actualizar mensaje
        $participantes_listas = DB::select(DB::raw("SELECT p.* , l3.nombre as parroquia, l2.nombre as municipio , l1.nombre as estado
                                        FROM Participante p, lugar l1, lugar l2, lugar l3
                                        where p.id=$id and p.fk_Lugar= l3.id and l3.fk_Lugar = l2.id and l2.fk_Lugar= l1.id
                                        ORDER BY cedula"
        ));
        foreach ($participantes_listas as $participanteID) {
            $participante=$participanteID;
        }
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
        $participantes_listas = DB::select(DB::raw("SELECT p.* , l3.id as parroquiaID , l3.nombre as parroquiaNombre,
                                        l2.id as municipioID, l2.nombre as municipioNombre, l1.id as estadoID , l1.nombre as estadoNombre
                                        FROM Participante p, lugar l1, lugar l2, lugar l3
                                        where p.id=$id and p.fk_Lugar= l3.id and l3.fk_Lugar = l2.id and l2.fk_Lugar= l1.id
                                        ORDER BY cedula"
        ));
        //esto lo hago asi ya que primero lo busco pero el problema es que este participante no tiene las columnas que me faltan del lugar , es por esto que lo traigo asi 
        $participantes_lista=DB::table('Participante')->where('id',$id)->first();
        foreach ($participantes_listas as $participanteID) {
            $participantes_lista=$participanteID;
            $estadoID= $participanteID->estadoID;
            $municipioID= $participanteID->municipioID;
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
        return view('participantes.edit', compact('participantes_lista', 'estados', 'municipios', 'parroquias'));
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

        //por si se ejecuta un parroquia igual a 0 
        if($request->input('parroquiaSelect') > 1){
            DB::select('CALL sp_update_participante(:p0, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10)',
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
                        'p10' => $request->input('parroquiaSelect'),
                    ));            
        }
        //llenado de la busqueda del evento para que quede igual de como estaba antes de hacer el eliminar
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p
                                                   ORDER BY cedula"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        $eventoAntesSeleccionado= null;
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'estados', 'eventoAntesSeleccionado'));
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
        $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                   FROM Participante p
                                                    ORDER BY cedula"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));        
        $eventoAntesSeleccionado= null;
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'estados', 'eventoAntesSeleccionado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function busquedaEvento($idEvento = 1) 
    {
        //caso en el que se seleccione de nuevo "seleccione un evento" entonces se le dan todos los participantes
        //de todos los eventos
        if($idEvento==0){
            $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                       FROM Participante p
                                                       ORDER BY cedula"
            ));
        }else{
            $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                       FROM Participante p, historial_usuario_evento h
                                                       WHERE p.id=fk_participante AND h.fk_evento=$idEvento
                                                       ORDER BY h.asistencia DESC, cedula"
            ));
        }
        return view('participantes.tabla' , compact('participantes_lista'));
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
        $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                   FROM Participante p, historial_usuario_evento h, historial_usuario_evento j
                                                   WHERE p.id=h.fk_participante AND 
                                                   h.fk_evento=j.fk_evento AND j.id = $id
                                                   ORDER BY h.asistencia DESC, cedula"
        ));
        $eventos = DB::select(DB::raw("SELECT id, nombre
                                       from Evento"
        ));
        $estados = DB::select(DB::raw("SELECT * 
                                        FROM Lugar 
                                        where tipo = 'Estado'"
        ));
        //esto es para no perder los datos del select del index al refrescar la pagina
        $eventoAntesSeleccionado=null;
        $eventoAntesSeleccionados=DB::select(DB::raw("SELECT e.id, e.nombre
                                                    from Evento e, historial_usuario_evento h
                                                    WHERE e.id=h.fk_evento AND h.id = $id"
        ));
        foreach ($eventoAntesSeleccionados as $evento) {
            $eventoAntesSeleccionado=$evento;
        }
        return view('participantes.index' , compact('participantes_lista', 'eventos', 'estados', 'eventoAntesSeleccionado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function buscador(Request $request){
        $idEventoSeleccionado = $request->evento;
        $palabra = $request->texto;
        //si es numerico lo busco por la cedula sino lo busco por los demas campos
        if(is_numeric($palabra)){
            if($idEventoSeleccionado == 0){
                $participantes_lista = DB::select(DB::raw("SELECT p.* , 0 as asistencia, 0 as idHistorial
                                                       FROM Participante p
                                                       where p.cedula like '$palabra%'
                                                       ORDER BY cedula" 
                ));
            }else{
                $participantes_lista = DB::select(DB::raw("SELECT p.* , h.asistencia, h.id as idHistorial
                                                           FROM Participante p, historial_usuario_evento h
                                                           WHERE p.id=fk_participante AND
                                                           h.fk_evento =$idEventoSeleccionado and
                                                           p.cedula like '$palabra%'
                                                           ORDER BY h.asistencia DESC, cedula" 
                ));
            }
        //busqueda por los demas campos
        }else{
            if($idEventoSeleccionado == 0){
                $participantes_lista = DB::select(DB::raw("SELECT DISTINCT p.* , 0 as asistencia, 0 as idHistorial
                                                       FROM Participante p
                                                       where p.pimer_nombre like '$palabra%' or p.segundo_nombre like '$palabra%' or p.primer_apellido like '$palabra%' or p.segundo_apellido like '$palabra%' or p.email like '$palabra%'
                                                       ORDER BY cedula" 
                ));
            }else{
                $participantes_lista = DB::select(DB::raw("SELECT DISTINCT p.* , h.asistencia, h.id as idHistorial
                                                           FROM Participante p, historial_usuario_evento h
                                                           WHERE  p.id=fk_participante AND
                                                                h.fk_evento =$idEventoSeleccionado 
                                                                and (p.pimer_nombre like '$palabra%' or p.segundo_nombre like '$palabra%' or p.primer_apellido like '$palabra%' or p.segundo_apellido like '$palabra%' or p.email like '$palabra%')
                                                            ORDER BY h.asistencia DESC, cedula" 
                ));
            }
        }
        return view('participantes.tabla' , compact('participantes_lista'));      
    }
}

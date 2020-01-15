<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=> ['create','store', 'index', 'show', 'edit','update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //funcion para trar todos los mensajes
        $participantes_lista = DB::table('Participante')->get();

        return view('participantes.index' , compact('participantes_lista'));
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

        //Model::unguard();
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
        $participantes_lista = DB::table('Participante')->get();
        return view('participantes.index' , compact('participantes_lista'));
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
                    'p8' =>  $request->input('telefono'),
                    'p9' =>  $request->input('tipo'),
                ));
        $participantes_lista = DB::table('Participante')->get();
        return view('participantes.index' , compact('participantes_lista'));
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
        $participantes_lista = DB::table('Participante')->get();
        return view('participantes.index' , compact('participantes_lista'));
    }
}

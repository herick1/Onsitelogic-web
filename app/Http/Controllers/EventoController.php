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

        return view('eventos.index' , compact('eventos_lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.create');
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
        $mensaje= $request->input('Evento');       
        DB::select('CALL sp_insert_evento(:p0, :p1, :p2, :p3, :p4)',
                array(
                    'p0' =>  $request->input('tipo'),
                    'p1' =>  $request->input('nombre'),
                    'p2' =>  $request->input('cantidad_de_personas'),
                    'p3' =>  $request->input('fecha_inicio'),
                    'p4' =>  $request->input('fecha_fin')
                ));
        $eventos_lista = DB::table('Evento')->get();
        return view('eventos.index' , compact('eventos_lista'));
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
        $eventos_lista = DB::table('Evento')->where('id',$id)->first();
        return view('eventos.edit', compact('eventos_lista'));
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
        $mensaje= $request->input('Evento');
        DB::select('CALL sp_update_evento(:p0, :p1, :p2, :p3, :p4, :p5)',
                array(
                    'p0' => $id,
                    'p1' =>  $request->input('tipo'),
                    'p2' =>  $request->input('nombre'),
                    'p3' =>  $request->input('cantidad_de_personas'),
                    'p4' =>  $request->input('fecha_inicio'),
                    'p5' =>  $request->input('fecha_fin'),
                ));
        $eventos_lista = DB::table('Evento')->get();
        return view('eventos.index' , compact('eventos_lista'));
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
        return view('eventos.index' , compact('eventos_lista'));
    }
}

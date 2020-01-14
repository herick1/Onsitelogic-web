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
        $messages = DB::table('mensajes')->get();

        return view('mensajes.index' , compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensajes.create');
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
        $mensaje= $request->input('mensaje');       
        DB::select('CALL sp_insert_mensajes(:p0, :p1, :p2)',
                array(
                    'p0' =>  $request->input('nombre'),
                    'p1' =>  $request->input('email'),
                    'p2' =>  $request->input('mensaje'),
                ));
        $messages = DB::table('mensajes')->get();
        return view('mensajes.index' , compact('messages'));
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
        $message = DB::table('mensajes')->where('id',$id)->first();
        return view('mensajes.show', compact('message'));
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
        $message = DB::table('mensajes')->where('id',$id)->first();
        return view('mensajes.edit', compact('message'));
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
        $mensaje= $request->input('mensaje');
        DB::select('CALL sp_update_mensajes(:p0, :p1)',
                array(
                    'p0' => $id,
                    'p1' => $mensaje
                ));
        $messages = DB::table('mensajes')->get();
        return view('mensajes.index' , compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::select('CALL sp_delete_mensajes(:p0)',
                array(
                    'p0' => $id
                ));
        $messages = DB::table('mensajes')->get();
        return view('mensajes.index' , compact('messages'));
    }
}

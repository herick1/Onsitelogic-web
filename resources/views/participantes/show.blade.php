@extends('layout.layout')

@section('contenido')

 <h1> Mensajes </h1>
	<p>{{$message->nombre}}</p>
	<p>{{$message->email}}</p>
	<p>{{$message->mensaje}}</p>
@stop;
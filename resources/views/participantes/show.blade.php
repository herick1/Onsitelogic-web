@extends('layout.layout')

@section('contenido')

 <h1> Participante </h1>
	<p>{{$participante->cedula}}</p>
	<p>{{$participante->email}}</p>
	<p>{{$participante->pimer_nombre}}</p>

@stop;
@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Detalles del participante</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
	    <br>
	   	<br>
        <strong>Cédula de identidad:&nbsp;</strong> <i>{{$participante->cedula}}</i><br>
        <strong>Email: &nbsp;</strong> <i>{{$participante->email}}</i><br>
        <strong>primer nombre :&nbsp;</strong> <i>{{$participante->pimer_nombre}}</i><br>
	    <br>
	   	<br>
        <a href="{{route('participantes.index')}}" class="btn btn-outline-info" role="button">
            Volver
        </a>
    </div>
    	<br>
    	<br>
@stop;
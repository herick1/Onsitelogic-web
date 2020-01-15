@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Detalles del participante</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
        <strong>Cédula de identidad:&nbsp;</strong> <i>{{$participante->cedula}}</i><br>
        <strong>Email: &nbsp;</strong> <i>{{$participante->email}}</i><br>
        <strong>Nombre(s):&nbsp;</strong> <i>{{$participante->pimer_nombre}}&nbsp;{{$participante->segundo_nombre}}</i>
        <br>
        <strong>Apellidos(s):&nbsp;</strong> <i>{{$participante->primer_apellido}}&nbsp;{{$participante->segundo_apellido}}</i><br>
        <strong>fecha de nacimiento: &nbsp;</strong> <i>{{$participante->fecha_de_nacimiento}}</i><br>
        <strong>Telefono: &nbsp;</strong> <i>{{$participante->telefono}}</i><br>
        <strong>Categoria: &nbsp;</strong> <i>{{$participante->tipo}}</i><br>
	    <br>
        <a href="{{route('participantes.index')}}" class="btn btn-outline-info" role="button">
            Volver
        </a>
    </div>
    	<br>
    	<br>
@stop;
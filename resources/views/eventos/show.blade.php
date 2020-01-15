@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Detalles del evento</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
        <strong>Tipo:&nbsp;</strong> <i>{{$evento->tipo}}</i><br>
        <strong>Nombre: &nbsp;</strong> <i>{{$evento->nombre}}</i><br>
        <strong>Cantidad de personas que aproximadamente asistira al evento :&nbsp;</strong> <i>{{$evento->cantidad_de_personas}}</i>
        <br>
        <strong>Fecha de inicio del evento:&nbsp;</strong> <i>{{$evento->fecha_inicio}}</i><br>
        <strong>Fecha de fin del evento: &nbsp;</strong> <i>{{$evento->fecha_fin}}</i><br>
        <br>
        <a href="{{route('eventos.index')}}" class="btn btn-outline-info" role="button">
            Volver
        </a>
    </div>
    <br>
    <br>
@stop;
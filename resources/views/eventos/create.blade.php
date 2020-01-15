@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Crear un nuevo Evento</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
		<form method="POST" action="{{ route('eventos.store') }}">
			{!!csrf_field()!!}

			<label for="tipo"><b> Tipo</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="tipo" >
				{!! $errors->first('tipo', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="nombre"><b>Nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="nombre">
				{!! $errors->first('nombre', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="cantidad_de_personas"><b>Cantidad de personas</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="cantidad_de_personas" >
				{!! $errors->first('cantidad_de_personas', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>
			<label for="fecha_inicio"><b>fecha de inicio del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_inicio" >
				{!! $errors->first('fecha_inicio', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="fecha_fin"><b>Fecha de fin del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_fin">
				{!! $errors->first('fecha_fin', '<span class=error>:eventos>/span>')!!} 
				</input>		
			</div>

			<input  class="btn btn-info" type="submit" value="enviar">
			<a href="{{route('eventos.index')}}" class="btn btn-outline-info" role="button">
    			Volver
			</a>
		</form>
		</form>
	</div>
@stop;
@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Crear un nuevo participante</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
		<form method="POST" action="{{ route('participantes.store') }}">
			{!!csrf_field()!!}
			<p><label for="nombre">
				nombre
				<input type="text" name="nombre" value="{{ old('nombre') }}" >
				{!! $errors->first('nombre', '<span class=error>:participantes>/span>')!!} 
			    </input>
			</label></p>
			<p><label for="email">
				Email
				<input type="text" name="email" value="{{old('email')}}">
				{!! $errors->first('email', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="primer_nombre">
				primer nombre
				<input type="text" name="primer_nombre" value="{{old('primer_nombre')}}">
				{!! $errors->first('primer_nombre', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			
				<input  class="btn btn-info" type="submit" value="enviar">
				<a href="{{route('participantes.index')}}" class="btn btn-outline-info" role="button">
        			Volver
    			</a>
		</form>
		</form>
	</div>
@stop;
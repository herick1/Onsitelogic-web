@extends('layout.layout')
@section('contenido')

<h1>Editar  PArticipante prueba</h1>
<form method="POST" action="{{ route('participantes.update', $participantes_lista->id) }}">
	{!!method_field('PUT')!!}
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

		<input type="submit" value="enviar">

</form>

@stop
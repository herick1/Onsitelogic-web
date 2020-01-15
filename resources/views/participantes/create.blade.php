@extends('layout.layout')

@section('contenido')

<h2>Crea una persona </h2>
@if(session()->has('info'))
	<h3>{{session('info')}}</h3>
@else
<form method="POST" action="{{ route('participantes.store') }}">
	{!!csrf_field()!!}
	<p><label for="nombre">
		nombre
		<input type="text" name="nombre" value="{{ old('nombre') }}" >
		{!! $errors->first('nombre', '<span class=error>:message>/span>')!!} 
	    </input>
	</label></p>
	<p><label for="email">
		Email
		<input type="text" name="email" value="{{old('email')}}">
		{!! $errors->first('email', '<span class=error>:message>/span>')!!} </input>
	</label></p>
	<p><label for="primer_nombre">
		primer nombre
		<input type="text" name="primer_nombre" value="{{old('primer_nombre')}}">
		{!! $errors->first('primer_nombre', '<span class=error>:message>/span>')!!} </input>
	</label></p>

		<input type="submit" value="enviar">

</form>
@endif
<hr>
@stop;
@extends('layout.layout')

@section('contenido')
<h1>Seccion de mensajes </h1>
<h2>escribe un mensaje </h2>
@if(session()->has('info'))
	<h3>{{session('info')}}</h3>
@else
<form method="POST" action="{{ route('mensajes.store') }}">
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
	<p><label for="mensaje">
		Mensaje
		<input type="text" name="mensaje" value="{{old('mensaje')}}">
		{!! $errors->first('mensaje', '<span class=error>:message>/span>')!!} </input>
	</label></p>

		<input type="submit" value="enviar">

</form>
@endif
<hr>
@stop;
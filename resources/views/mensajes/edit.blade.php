@extends('layout.layout')
@section('contenido')

<h1>Editar  Mensaje</h1>
<form method="POST" action="{{ route('mensajes.update', $message->id) }}">
	{!!method_field('PUT')!!}
	{!!csrf_field()!!}
	<p><label for="nombre">
		nombre
		<input type="text" name="nombre" value="{{ $message->nombre }}" >
		{!! $errors->first('nombre', '<span class=error>:message>/span>')!!} 
	    </input>
	</label></p>
	<p><label for="email">
		Email
		<input type="text" name="email" value="{{$message->email}}">
		{!! $errors->first('email', '<span class=error>:message>/span>')!!} </input>
	</label></p>
	<p><label for="mensaje">
		Mensaje
		<input type="text" name="mensaje" value="{{$message->mensaje}}">
		{!! $errors->first('mensaje', '<span class=error>:message>/span>')!!} </input>
	</label></p>

		<input type="submit" value="enviar">

</form>

@stop
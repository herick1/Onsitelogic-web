@extends('layout.layout')

@section('contenido')

<h1 > controles de busqueda</h1>
 <h1>Todos Los participantes </h1>
<table width="100%" border="1">
	<thread>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Mensaje</th>
			<th>Acciones</th>
		</tr>
	</thread>
	<body>
		@foreach($participantes_lista as $participante)
		<tr>

			<td>{{$participante->id}}</td>
			<td>
				<a href="{{route('participantes.show', $participante->id)}}" > 
					{{$participante->pimer_nombre}}
				</a>
			</td>
			<td>{{$participante->email}}</td>
			<td>{{$participante->segundo_nombre}}</td>
			<td>
				<a href="{{route('participantes.edit', $participante->id)}}">Editar</a>
				<form style="display:inline" method="POST" action="{{route('participantes.destroy',$participante->id)}}">
					{!!method_field('DELETE')!!}
					{!!csrf_field()!!}
					<button type="submit">Eliminar</button>					
				</form>
			</td>
		</tr>
		@endforeach
	</body>
</table>

@stop;
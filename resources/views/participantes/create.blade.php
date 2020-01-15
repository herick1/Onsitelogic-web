@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Crear un nuevo participante</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
		<form method="POST" action="{{ route('participantes.store') }}">
			{!!csrf_field()!!}
			<p><label for="cedula">
				cedula
				<br>
				<input  class="form-control" type="number" name="cedula" >
				{!! $errors->first('cedula', '<span class=error>:participantes>/span>')!!} 
			    </input>
			</label></p>

			<p><label for="primer_nombre">
				primer nombre
				<br>
				<input  class="form-control" type="text" name="primer_nombre" >
				{!! $errors->first('primer_nombre', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="primer_nombre">
				Segundo nombre
				<br>
				<input  class="form-control" type="text" name="segundo_nombre" >
				{!! $errors->first('segundo_nombre', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="primer_nombre">
				primer apellido
				<br>
				<input  class="form-control" type="text" name="primer_apellido">
				{!! $errors->first('primer_apellido', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="primer_nombre">
				Segundo apellido
				<br>
				<input  class="form-control" type="text" name="segundo_apellido" >
				{!! $errors->first('segundo_apellido', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="email">
				Email
				<br> 
				<input  class="form-control" type="text" name="email" >
				{!! $errors->first('email', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>
			<p><label for="fecha_de_nacimiento">
				Fecha de nacimiento
				<br>
				<input  class="form-control" type="date" name="fecha_de_nacimiento">
				{!! $errors->first('fecha_de_nacimiento', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>		
			<p><label for="telefono">
				Telefono				
				<br>
				<input  class="form-control" type="text" name="telefono">
				{!! $errors->first('telefono', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>	
			<p><label for="tipo">
				Tipo
				<select class="card text-left p-2" name="tipo">
				       <option selected value="Visitante">Visitante</option>
				       <option value="Exponente">Exponente</option> 
				       <option  value="Asesor">Asesor</option> 
				       <option value="Otros">Otros</option> 
				</select>
				{!! $errors->first('telefono', '<span class=error>:participantes>/span>')!!} </input>
			</label></p>

			
				<input  class="btn btn-info" type="submit" value="enviar">
				<a href="{{route('participantes.index')}}" class="btn btn-outline-info" role="button">
        			Volver
    			</a>
		</form>
		</form>
	</div>
@stop;
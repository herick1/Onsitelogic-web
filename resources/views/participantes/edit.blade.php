@extends('layout.layout')
@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Editar un participante</h1>
    </div>
    <div class=" col-sm-8 col-12 card text-left p-5" style="margin-left: 15%">
		<form method="POST" action="{{ route('participantes.update', $participantes_lista->id) }}">
			{!!method_field('PUT')!!}
			{!!csrf_field()!!}       
			<label for="cedula"><b>cedula</b></label>
			<div class="form-group">
				<input  class="form-control" type="number" name="cedula"  class="form-control input-lg" value="{{$participantes_lista->cedula}}">
				{!! $errors->first('cedula', '<span class=error>:participantes>/span>')!!} 
			    </input>
		    </div>

			<label for="primer_nombre"><b>primer nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_nombre" value="{{$participantes_lista->pimer_nombre}}">
				{!! $errors->first('primer_nombre', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="primer_nombre"><b>Segundo nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_nombre" value="{{$participantes_lista->segundo_nombre}}" >
				{!! $errors->first('segundo_nombre', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="primer_nombre"><b>primer apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_apellido" value="{{$participantes_lista->primer_apellido}}">
				{!! $errors->first('primer_apellido', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="primer_nombre"><b>Segundo apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_apellido" value="{{$participantes_lista->segundo_apellido}}">
				{!! $errors->first('segundo_apellido', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>
			<label for="email"><b>Email</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="email" value="{{$participantes_lista->email}}" >
				{!! $errors->first('email', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="fecha_de_nacimiento"><b>Fecha de nacimiento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_de_nacimiento" value="{{$participantes_lista->fecha_de_nacimiento}}">
				{!! $errors->first('fecha_de_nacimiento', '<span class=error>:participantes>/span>')!!} 
				</input>		
			</div>

			<label for="telefono"><b>Telefono</b>	
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="telefono" value="{{$participantes_lista->telefono}}">
				{!! $errors->first('telefono', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="tipo"><b>Tipo</b></label>
			<select class="card text-left p-2" name="tipo">
			       <option class="dropdown-menu" selected value="{{$participantes_lista->tipo}}">{{$participantes_lista->tipo}}</option>
			       <option value="Visitante">Visitante</option>
			       <option value="Exponente">Exponente</option> 
			       <option  value="Asesor">Asesor</option> 
			       <option value="Otros">Otros</option> 
			</select>

			<br>
			<br>	
			<div class="form-group row col-12">
				<input  class="btn btn-info mr-2" type="submit" value="Enviar">
				<a href="{{route('participantes.index')}}" class="btn btn-outline-info" role="button">
        			Volver
    			</a>
			</div>
		</form>
		</form>
	</div>

@stop
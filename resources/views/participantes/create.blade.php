    <div class="text-left">
		<form method="POST" action="{{ route('participantes.store') }}">
			{!!csrf_field()!!}
			<label for="cedula"><b>cedula</b></label>
			<div class="form-group">
				<input   type="number" name="cedula"  class="form-control input-lg" max=999999999 required>
				{!! $errors->first('cedula', '<span class=error>:participantes>/span>')!!} 
			    </input>
		    </div>


			<label for="primer_nombre"><b>primer nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_nombre" maxlength="30" required>
				{!! $errors->first('primer_nombre', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="segundo_nombre"><b>Segundo nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_nombre" maxlength="60">
				{!! $errors->first('segundo_nombre', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="primer_apellido"><b>primer apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_apellido" maxlength="30" required>
				{!! $errors->first('primer_apellido', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>

			<label for="segundo_apellido"><b>Segundo apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_apellido" maxlength="60" >
				{!! $errors->first('segundo_apellido', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>
			<label for="email"><b>Email</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="email" name="email" maxlength="200" required>
				{!! $errors->first('email', '<span class=error>:participantes>/span>')!!} 
				</input>
			</div>


			<label for="lugar"><b>Dirección</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<p>estado</p>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="0">Seleccione un estado</option>
		                @foreach($estados as $estado)
		                    <option  value="{{$estado->id}}">{{$estado->nombre}}</option>
		                @endforeach
					</select>
				</div>
			    <div id="contenedor2">
			    	<p>Municipio</p>
					<select id="municipioSelect" class="card text-left p-2">
						<option value="0">Seleccione un municipio</option>
					</select>
			    </div>			
			    <div id="contenedor3">
			    	<p>Parroquia</p>
					<select name="parroquiaSelect" id="parroquiaSelect" class="card text-left p-2">
						<option value="0">Seleccione una parroquia</option>
					</select>
			    </div>
			</div>	


			<label for="fecha_de_nacimiento"><b>Fecha de nacimiento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_de_nacimiento" required>
				{!! $errors->first('fecha_de_nacimiento', '<span class=error>:participantes>/span>')!!} 
				</input>		
			</div>

			<label for="telefono"><b>Telefono</b>	
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="telefono" maxlength="30" >

				</input>
			</div>

			<label for="tipo"><b>Tipo</b></label>
			<select class="card text-left p-2" name="tipo" >
			       <option selected value="Visitante">Visitante</option>
			       <option value="Exponente">Exponente</option> 
			       <option  value="Asesor">Asesor</option> 
			       <option value="Otros">Otros</option> 
			</select>

			<br>
			<br>			
			<input  class="btn btn-info" type="submit" value="enviar">
	        <a  type="button" class="btn btn-info" data-dismiss="modal">
	            Volver
	        </a>
		</form>
		</form>
	</div>



<script type="text/javascript">
	$(function() {

  		estado = function(){

            fetch(`/lugar/buscadorMunicipio?estado=${document.getElementById("estadoSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor2").innerHTML = html;
 									document.getElementById("contenedor3").innerHTML = '<p>Parroquia</p><select id="parroquiaSelect" class="card text-left p-2"><option value="0">Seleccione una parroquia</option></select>'
        	})
  		}
  		buscarParroquia = function(){

            fetch(`/lugar/buscadorParroquia?municipio=${document.getElementById("municipioSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor3").innerHTML = html
        	})
  		}
		
	})
</script>


	
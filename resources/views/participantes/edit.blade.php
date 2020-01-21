    <div class="text-left">
		<form method="POST" action="{{ route('participantes.update', $participantes_lista->id) }}">
			{!!method_field('PUT')!!}
			{!!csrf_field()!!}       
			<label for="cedula"><b>cedula</b></label>
			<div class="form-group">
				<input  class="form-control" type="number" max=999999999 name="cedula"  class="form-control input-lg" value="{{$participantes_lista->cedula}}"  required >
			    </input>
		    </div>

			<label for="primer_nombre"><b>Primer nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" maxlength="30" name="primer_nombre" value="{{$participantes_lista->pimer_nombre}}" required> 
				</input>
			</div>

			<label for="segundo_apellido"><b>Segundo nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_nombre" value="{{$participantes_lista->segundo_nombre}}" maxlength="60" >
				</input>
			</div>

			<label for="primer_apellido"><b>Primer apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_apellido" value="{{$participantes_lista->primer_apellido}}" maxlength="30" required> 
				</input>
			</div>

			<label for="segundo_apellido"><b>Segundo apellido</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_apellido"  maxlength="60" value="{{$participantes_lista->segundo_apellido}}">
				</input>
			</div>
			<label for="email"><b>Email</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="email" name="email" value="{{$participantes_lista->email}}" maxlength="200" required> 
				</input>
			</div>

			<label for="lugar"><b>Dirección</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<p>estado</p>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="{{$participantes_lista->estadoID}}">{{$participantes_lista->estadoNombre}}</option>
		                <optgroup label="opciones"> 
		              	<option  value="0">Seleccione un estado</option>
			                @foreach($estados as $estado)
			                    <option  value="{{$estado->id}}">{{$estado->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
				</div>
			    <div id="contenedor2">
			    	<p>Municipio</p>
					<select id="municipioSelect" class="card text-left p-2">
		                <option Select value="{{$participantes_lista->municipioID}}">{{$participantes_lista->municipioNombre}}</option>
		                <optgroup label="opciones"> 
		              	<option  value="0">Seleccione un municipio</option>
			                @foreach($municipios as $municipio)
			                    <option  value="{{$municipio->id}}">{{$municipio->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
			    </div>			
			    <div id="contenedor3">
			    	<p>Parroquia</p>
					<select id="parroquiaSelect" class="card text-left p-2" name="parroquiaSelect">
		                <option Select value="{{$participantes_lista->parroquiaID}}">{{$participantes_lista->parroquiaNombre}}</option>
		                <optgroup label="opciones"> 
		              	<option  value="0">Seleccione una parroquia</option>
			                @foreach($parroquias as $parroquia)
			                    <option  value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
			    </div>
			</div>	

			<label for="fecha_de_nacimiento"><b>Fecha de nacimiento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_de_nacimiento" value="{{$participantes_lista->fecha_de_nacimiento}}" required>
				</input>		
			</div>

			<label for="telefono"><b>Telefono</b>	
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="telefono" value="{{$participantes_lista->telefono}}" maxlength="30">
				</input>
			</div>

			<label for="tipo"><b>Tipo</b></label>
			<select class="card text-left p-2" name="tipo">
			       <option class="dropdown-menu" selected value="{{$participantes_lista->tipo}}">{{$participantes_lista->tipo}}</option>
			       <optgroup label="opciones">
				       <option value="Visitante">Visitante</option>
				       <option value="Exponente">Exponente</option> 
				       <option  value="Asesor">Asesor</option> 
				       <option value="Otros">Otros</option> 
			   	   </optgroup> 
			</select>

			<br>
			<br>	
			<div class="form-group row col-12">
				<input  class="btn btn-info mr-2" type="submit" value="Enviar">
		        <a  type="button" class="btn btn-info" data-dismiss="modal">
		            Volver
		        </a>
			</div>
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
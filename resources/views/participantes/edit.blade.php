     
			<label for="cedula"><b>Identification card</b></label>
			<div class="form-group">
				<input  class="form-control" type="number" max=999999999 name="cedula"  class="form-control input-lg" value="{{$participantes_lista->cedula}}"  required >
			    </input>
		    </div>

			<label for="primer_nombre"><b>First name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" maxlength="30" name="primer_nombre" value="{{$participantes_lista->pimer_nombre}}" required> 
				</input>
			</div>

			<label for="segundo_apellido"><b>Second name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_nombre" value="{{$participantes_lista->segundo_nombre}}" maxlength="60" >
				</input>
			</div>

			<label for="primer_apellido"><b>First last name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_apellido" value="{{$participantes_lista->primer_apellido}}" maxlength="30" required> 
				</input>
			</div>

			<label for="segundo_apellido"><b>Second last name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_apellido"  maxlength="60" value="{{$participantes_lista->segundo_apellido}}">
				</input>
			</div>
			<label for="email"><b>Email</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="email" name="email" value="{{$participantes_lista->email}}" maxlength="200" required> 
				</input>
			</div>

			<label for="lugar"><b>Address</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<b>State</b>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="{{$participantes_lista->estadoID}}">{{$participantes_lista->estadoNombre}}</option>
		                <optgroup label="options"> 
		              	<option  value="0">Select a state</option>
			                @foreach($estados as $estado)
			                    <option  value="{{$estado->id}}">{{$estado->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
				</div>
			    <div id="contenedor2">
			    	<b>Municipality</b>
					<select id="municipioSelect" class="card text-left p-2">
		                <option Select value="{{$participantes_lista->municipioID}}">{{$participantes_lista->municipioNombre}}</option>
		                <optgroup label="options"> 
		              	<option  value="0">Select a municipality</option>
			                @foreach($municipios as $municipio)
			                    <option  value="{{$municipio->id}}">{{$municipio->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
			    </div>			
			    <div id="contenedor3">
			    	<b>Parish</b>
					<select id="parroquiaSelect" class="card text-left p-2" name="parroquiaSelect">
		                <option Select value="{{$participantes_lista->parroquiaID}}">{{$participantes_lista->parroquiaNombre}}</option>
		                <optgroup label="options"> 
		              	<option  value="0">Select a parish</option>
			                @foreach($parroquias as $parroquia)
			                    <option  value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
			    </div>
			</div>	

			<label for="fecha_de_nacimiento"><b>Date of birth</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_de_nacimiento" value="{{$participantes_lista->fecha_de_nacimiento}}" required>
				</input>		
			</div>

			<label for="telefono"><b>Phone</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="telefono" value="{{$participantes_lista->telefono}}" maxlength="30">
				</input>
			</div>

			<label for="tipo"><b>Type</b></label>
			<select class="card text-left p-2" name="tipo">
			       <option class="dropdown-menu" selected value="{{$participantes_lista->tipo}}">{{$participantes_lista->tipo}}</option>
			       <optgroup label="options">
				       <option  value="Visitor">Visitor</option>
				       <option value="Exponent">Exponent</option> 
				       <option  value="Advisor">Advisor</option> 
				       <option value="Others">Others</option> 
			   	   </optgroup> 
			</select>
	</div>
	<div class="float-right">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#UpdateYesNoModal{{$participantes_lista->id}}">Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>



<script type="text/javascript">
	$(function() {
  		estado = function(){
            fetch(`/lugar/buscadorMunicipio?estado=${document.getElementById("estadoSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor2").innerHTML = html;
 									document.getElementById("contenedor3").innerHTML = '<b>Parish</b><select id="parroquiaSelect" class="card text-left p-2"><option value="0">Select a parish</option></select>'
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
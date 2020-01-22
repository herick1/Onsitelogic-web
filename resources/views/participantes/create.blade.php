    <div class="text-left">
		<form method="POST" action="{{ route('participantes.store') }}">
			{!!csrf_field()!!}
			<label for="cedula"><b>Identification card</b></label>
			<div class="form-group">
				<input   type="number" name="cedula"  class="form-control input-lg" value="{{old('cedula')}}" max=999999999 required>
			    </input>
		    </div>


			<label for="primer_nombre"><b>First name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_nombre" value="{{old('primer_nombre')}}" maxlength="30" required>
				</input>
			</div>

			<label for="segundo_nombre"><b>Second name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_nombre"  value="{{old('segundo_nombre')}}"  maxlength="60">
				</input>
			</div>

			<label for="primer_apellido"><b>First last name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="primer_apellido" value="{{old('primer_apellido')}}" maxlength="30" required>
				</input>
			</div>

			<label for="segundo_apellido"><b>Second last name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="segundo_apellido" value="{{old('segundo_apellido')}}"  maxlength="60" >
				</input>
			</div>
			<label for="email"><b>Email</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="email" name="email" maxlength="200"  value="{{old('email')}}" required>
				</input>
			</div>


			<label for="lugar"><b>Address</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<b>State</b>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="0">Select a state</option>
		                @foreach($estados as $estado)
		                    <option  value="{{$estado->id}}">{{$estado->nombre}}</option>
		                @endforeach
					</select>
				</div>
			    <div id="contenedor2">
			    	<b>Municipality</b>
					<select id="municipioSelect" class="card text-left p-2">
						<option value="0">select a municipality</option>
					</select>
			    </div>			
			    <div id="contenedor3">
			    	<b>Parish</b>
					<select  id="parroquiaSelect" class="card text-left p-2">
						<option>Select a parish</option>
					</select>
			    </div>
			</div>	


			<label for="fecha_de_nacimiento"><b>Date of birth</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" value="{{old('fecha_de_nacimiento')}}" name="fecha_de_nacimiento" required> 
				</input>		
			</div>

			<label for="telefono"><b>Phone</b>	
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="telefono"  value="{{old('telefono')}}" nmaxlength="30" >

				</input>
			</div>

			<label for="tipo"><b>Type</b></label>
			<select class="card text-left p-2" name="tipo" >
			       <option selected value="Visitor">Visitor</option>
			       <option value="Exponent">Exponent</option> 
			       <option  value="Advisor">Advisor</option> 
			       <option value="Others">Others</option> 
			</select>

			<br>
			<br>			
			<input  class="btn btn-info" type="submit" value="Send">
	        <button class="btn btn-info" data-dismiss="modal">
	            Return
	        </button>
		</form>
		</form>
	</div>



<script type="text/javascript">
	$(function() {

  		estado = function(){

            fetch(`/lugar/buscadorMunicipio?estado=${document.getElementById("estadoSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor2").innerHTML = html;
 									document.getElementById("contenedor3").innerHTML = '<b>Parish</b><select id="parroquiaSelect" class="card text-left p-2"><option>Select a parish</option></select>'
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


	
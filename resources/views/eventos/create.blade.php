    <div class="text-left">
		<form method="POST" action="{{ route('eventos.store') }}">
			{!!csrf_field()!!}

			<label for="tipo"><b> Type</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="tipo"   maxlength="20" required>
				</input>
			</div>

			<label for="nombre"><b>Name</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="nombre" required maxlength="60">
				</input>
			</div>

			<label for="cantidad_de_personas"><b>Amount of people</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="number" name="cantidad_de_personas" max=99999>
				</input>
			</div>

			<label for="lugar"><b>Address</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<p>State</p>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="0">Select a state</option>
		                @foreach($estados as $estado)
		                    <option  value="{{$estado->id}}">{{$estado->nombre}}</option>
		                @endforeach
					</select>
				</div>
			    <div id="contenedor2">
			    	<p>Municipality</p>
					<select id="municipioSelect" class="card text-left p-2">
						<option value="0">Select a municipality </option>
					</select>
			    </div>			
			    <div id="contenedor3">
			    	<p>Parish</p>
					<select id="parroquiaSelect" class="card text-left p-2" name="parroquiaSelect">
						<option value="0">Select a parish</option>
					</select>
			    </div>
			</div>	

			<label for="fecha_inicio"><b>Event start date</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_inicio" >
				</input>
			</div>

			<label for="fecha_fin"><b>Event end date</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_fin">
				</input>		
			</div>

			<br>
			<br>			
			<input  class="btn btn-info" type="submit" value="enviar">
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
 									document.getElementById("contenedor3").innerHTML = '<p>Parish</p><select id="parroquiaSelect" class="card text-left p-2"><option value="0">Select a parish</option></select>'
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
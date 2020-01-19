    <div class="text-left">
		<form method="POST" action="{{ route('eventos.store') }}">
			{!!csrf_field()!!}

			<label for="tipo"><b> Tipo</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="tipo" required>
				{!! $errors->first('tipo', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="nombre"><b>Nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="nombre" required>
				{!! $errors->first('nombre', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="cantidad_de_personas"><b>Cantidad de personas</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="number" name="cantidad_de_personas" >
				{!! $errors->first('cantidad_de_personas', '<span class=error>:eventos>/span>')!!} 
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
					<select id="parroquiaSelect" class="card text-left p-2" min=1>
						<option value="0">Seleccione una parroquia</option>
					</select>
			    </div>
			</div>	

			<label for="fecha_inicio"><b>fecha de inicio del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_inicio" >
				{!! $errors->first('fecha_inicio', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="fecha_fin"><b>Fecha de fin del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_fin">
				{!! $errors->first('fecha_fin', '<span class=error>:eventos>/span>')!!} 
				</input>		
			</div>

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
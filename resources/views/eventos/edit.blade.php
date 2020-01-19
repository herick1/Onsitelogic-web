    <div class="text-left">
		<form method="POST" action="{{ route('eventos.update', $eventos_lista->id) }}">
			{!!method_field('PUT')!!}
			{!!csrf_field()!!}

			<label for="tipo"><b> Tipo</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="tipo" value="{{$eventos_lista->tipo }}"  maxlength="20">
				{!! $errors->first('tipo', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="nombre"><b>Nombre</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="text" name="nombre" value="{{$eventos_lista->nombre }}"  maxlength="60">
				{!! $errors->first('nombre', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="cantidad_de_personas"><b>Cantidad de personas</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="number" name="cantidad_de_personas" value="{{$eventos_lista->cantidad_de_personas }}" max=99999>
				{!! $errors->first('cantidad_de_personas', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="lugar"><b>Dirección</b></label>
			<div class="row p-3">
			    <div id="contenedor1">
					<p>estado</p>
					<select id="estadoSelect" class="card text-left p-2" onchange="estado()">
		                <option Select value="{{$eventos_lista->estadoID}}">{{$eventos_lista->estadoNombre}}</option>
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
		                <option Select value="{{$eventos_lista->municipioID}}">{{$eventos_lista->municipioNombre}}</option>
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
		                <option Select value="{{$eventos_lista->parroquiaID}}">{{$eventos_lista->parroquiaNombre}}</option>
		                <optgroup label="opciones"> 
		              	<option  value="0">Seleccione una parroquia</option>
			                @foreach($parroquias as $parroquia)
			                    <option  value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
			                @endforeach
		              	</optgroup>
					</select>
			    </div>
			</div>	


			<label for="fecha_inicio"><b>fecha de inicio del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_inicio" value="{{$eventos_lista->fecha_inicio }}" >
				{!! $errors->first('fecha_inicio', '<span class=error>:eventos>/span>')!!} 
				</input>
			</div>

			<label for="fecha_fin"><b>Fecha de fin del evento</b></label>
			<div class="form-group">
				<input  class="form-control input-lg" type="date" name="fecha_fin" value="{{$eventos_lista->fecha_fin }}">
				{!! $errors->first('fecha_fin', '<span class=error>:eventos>/span>')!!} 
				</input>		
			</div>

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
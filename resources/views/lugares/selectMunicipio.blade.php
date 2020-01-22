	<b>Municipality</b>
	<select id="municipioSelect" class="card text-left p-2"  onchange="buscarParroquia()">
		<option  value="0">Select a municipality</option>
        @foreach($select as $municipio)
            <option  value="{{$municipio->id}}">{{$municipio->nombre}}</option>
        @endforeach
	</select>

<script type="text/javascript">
	$(function() {

  		buscarParroquia = function(){
            fetch(`/lugar/buscadorParroquia?municipio=${document.getElementById("municipioSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor3").innerHTML = html
        	})
  		}		
	})
</script>
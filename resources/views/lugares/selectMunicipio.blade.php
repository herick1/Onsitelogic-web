<div class="col p-0">
	<select id="municipio" class="form-control" onchange="buscarParroquia()">
		<option value="0">---------</option>
		<option value="1">buu</option>
		<option value="2">bee</option>
		<option value="3">bi</option>
	</select>
</div>

<script type="text/javascript">
	$(function() {

  		buscarParroquia = function(){

            fetch(`/lugar/buscadorParroquia?municipio=${document.getElementById("municipio").value}`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedor3").innerHTML = html
        	})
  		}		
	})
</script>
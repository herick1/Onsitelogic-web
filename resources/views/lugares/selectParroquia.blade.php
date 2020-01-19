	<p>Parroquia</p>
	<select id="parroquiaSelect" class="card text-left p-2"  min=1>
		<option Select value="0">Seleccione una parroquia</option>
        @foreach($select as $parroquia)
            <option  value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
        @endforeach
	</select>
	<b>Parish</b>
	<select id="parroquiaSelect" class="card text-left p-2" name="parroquiaSelect">
		<option  value="0">Select a parish</option>
        @foreach($select as $parroquia)
            <option  value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
        @endforeach
	</select>
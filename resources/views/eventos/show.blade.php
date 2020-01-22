   <div class="text-left" style="font-weight: normal;">
        <strong>Type:&nbsp;</strong> <i>{{$evento->tipo}}</i><br>
        <strong>Name: &nbsp;</strong> <i>{{$evento->nombre}}</i><br>
        <strong>Number of people in the event:&nbsp;</strong> <i>{{$evento->cantidad_de_personas}}</i>
        <br>
        <strong>Event start date:&nbsp;</strong> <i>{{$evento->fecha_inicio}}</i><br>
        <strong>Event end date: &nbsp;</strong> <i>{{$evento->fecha_fin}}</i><br>
        <strong>Address:&nbsp;</strong> <i>{{$evento->estado}},&nbsp;{{$evento->municipio}},&nbsp;{{$evento->parroquia}}</i>
        <br>
        <br>
        <button class="btn btn-info" data-dismiss="modal">
            Return
        </button>
    </div>
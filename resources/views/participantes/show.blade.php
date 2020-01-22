    @if($participante)
    <div class="text-left" style="font-weight: normal;">
        <strong>Identification card:&nbsp;</strong> {{$participante->cedula}}<br>
        <strong>Email: &nbsp;</strong> <i>{{$participante->email}}</i><br>
        <strong>Name(s):&nbsp;</strong> <i>{{$participante->pimer_nombre}}&nbsp;{{$participante->segundo_nombre}}</i>
        <br>
        <strong>Last name(s):&nbsp;</strong> <i>{{$participante->primer_apellido}}&nbsp;{{$participante->segundo_apellido}}</i><br>
        <strong>Date of birth: &nbsp;</strong> <i>{{$participante->fecha_de_nacimiento}}</i><br>
        <strong>Phone: &nbsp;</strong> <i>{{$participante->telefono}}</i><br>
        <strong>Type: &nbsp;</strong> <i>{{$participante->tipo}}</i><br>
        <strong>Address:&nbsp;</strong> <i>{{$participante->estado}},&nbsp;{{$participante->municipio}},&nbsp;{{$participante->parroquia}}</i>
        <br>
        <button class="btn btn-info float-right" data-dismiss="modal">
            Back
        </button>
    </div>
    @endif
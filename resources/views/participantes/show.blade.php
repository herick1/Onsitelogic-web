    <div class="text-left" style="font-weight: normal;">
        <strong>Cédula de identidad:&nbsp;</strong> {{$participante->cedula}}<br>
        <strong>Email: &nbsp;</strong> <i>{{$participante->email}}</i><br>
        <strong>Nombre(s):&nbsp;</strong> <i>{{$participante->pimer_nombre}}&nbsp;{{$participante->segundo_nombre}}</i>
        <br>
        <strong>Apellidos(s):&nbsp;</strong> <i>{{$participante->primer_apellido}}&nbsp;{{$participante->segundo_apellido}}</i><br>
        <strong>fecha de nacimiento: &nbsp;</strong> <i>{{$participante->fecha_de_nacimiento}}</i><br>
        <strong>Telefono: &nbsp;</strong> <i>{{$participante->telefono}}</i><br>
        <strong>Categoria: &nbsp;</strong> <i>{{$participante->tipo}}</i><br>
	    <br>
        <a  type="button" class="btn btn-info" data-dismiss="modal">
            Volver
        </a>
    </div>
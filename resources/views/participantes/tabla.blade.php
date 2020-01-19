   <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th>Email</th>
                    <th>Asistencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
				@foreach($participantes_lista as $participante)
				<tr>
                    <td>
                        <a onclick="selecionadoShow({{$participante->id}})" data-toggle="modal" data-target="#showModal" type="button"  >
                                {{$participante->cedula}}
                        </a>
                    </td>
					<td>
                        <a onclick="selecionadoShow({{$participante->id}})" data-toggle="modal" data-target="#showModal"type="button" >
                            {{$participante->pimer_nombre}}&nbsp;{{$participante->segundo_nombre}}
                        </a>
                    </td>         
                    <td>
                        <a onclick="selecionadoShow({{$participante->id}})" data-toggle="modal" data-target="#showModal" type="button" >
                            {{$participante->primer_apellido}}&nbsp;{{$participante->segundo_apellido}}
                        </a>
                    </td>
					<td>
                        <a onclick="selecionadoShow({{$participante->id}})" data-toggle="modal" data-target="#showModal" type="button" >
                            {{$participante->email}}
                        </a>
                    </td>
					<td> 	
                        @if($participante->asistencia == 1)
                            @if($participante->idHistorial != 0)
                                <form style="display:inline" method="POST" action="{{route('UpdateAsistencia', [$participante->idHistorial,0])}}">
                                    {!!csrf_field()!!}
                                        <button class="btn btn-success"  type="submit" style="width: 50px;">
                                        Si
                                        </button>                 
                                </form>
                            @else
                                <button data-toggle="modal" data-target="#updateasistenciaModal"class="btn btn-success" style="width: 50px;">
                                Si
                                </button>
                            @endif
                        @else
                            @if($participante->idHistorial != 0)
                                <form style="display:inline" method="POST" action="{{route('UpdateAsistencia', [$participante->idHistorial, 1])}}">
                                    {!!csrf_field()!!}
                                        <button class="btn btn-danger"  type="submit" style="width: 50px;">
                                        No
                                        </button>                 
                                </form>
                            @else
                                <button class="btn btn-danger" data-toggle="modal" data-target="#updateasistenciaModal" style="width: 50px;">
                                No
                                </button>
                            @endif
                        @endif					
					</td>
					<td>
						<!-- BOTONES -->
                        <a data-toggle="modal" data-target="#actualizarModal" >
							<button class="btn btn-primary" onclick="selecionadoActualizar({{$participante->id}})">
                            Actualizar
                            </button>
						</a>
                        <a data-toggle="modal" data-target="#eliminarModal{{$participante->id}}">
                            <button class="btn btn-danger">
                            Eliminar 
                            </button>
                        </a>
                        
                        <!-- MODALES-->
                        <div class="modal fade" id="eliminarModal{{$participante->id}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar participante</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ¿Esta usted seguro que quiere eliminar este participante?
                                  </div>
                                  <div class="modal-footer">

                                    <form style="display:inline" method="POST" action="{{route('participantes.destroy',$participante->id)}}">
                                            {!!method_field('DELETE')!!}
                                            {!!csrf_field()!!}
                                            <button class="btn btn-danger" type="submit">Eliminar</button>                 
                                    </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                  </div>
                                </div>
                            </div>
                        </div>
					</td>
				</tr>
				@endforeach
            </tbody>
        </table>
    </div>

    <!-- modal de actualizar-->
    <div class="modal fade" id="actualizarModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Actualizar información del participante</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body" id="contenedorDeModalActualizar">
                </div>
            </div>
        </div>
    </div>

    <!-- modal de show-->
    <div class="modal fade" id="showModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Información del participante</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body" id="contenedorDeModalShow">
                </div>
            </div>
        </div>
    </div>

    <!-- modal de updateasistencia sin haber puesto un evento-->
    <div class="modal fade" id="updateasistenciaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Elija primero un evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-weight: normal;">
                Para poder actualizar una asistencia primero debe seleccionar un evento
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
              </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(function() {
        selecionadoActualizar = function(id){
            fetch(`/participantes/`+id+`/edit`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedorDeModalActualizar").innerHTML = html ;
                                    document.getElementById("texto").value = ""
             })
        }
        selecionadoShow = function(id){
            fetch(`/participantes/`+id,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedorDeModalShow").innerHTML = html ;
                                    document.getElementById("texto").value = ""
             })
        }
    })
    </script>
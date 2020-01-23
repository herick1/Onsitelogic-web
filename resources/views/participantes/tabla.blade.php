   <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Identification card</th>
                    <th>Name(s)</th>
                    <th>Last name(s)</th>
                    <th>Email</th>
                    <th>Assistance</th>
                    <th>Actions</th>
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
                                        Yes
                                        </button>                 
                                </form>
                            @else
                                <button data-toggle="modal" data-target="#updateasistenciaModal"class="btn btn-success" style="width: 50px;">
                                Yes
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
                        <a data-toggle="modal" data-target="#actualizarModal{{$participante->id}}" >
							<button class="btn btn-primary" onclick="selecionadoActualizar({{$participante->id}})">
                            Update
                            </button>
						</a>
                        <a data-toggle="modal" data-target="#eliminarModal{{$participante->id}}">
                            <button class="btn btn-danger">
                            Delete 
                            </button>
                        </a>
                        
                            <!-- MODALES-->

                            <div class="modal fade" id="eliminarModal{{$participante->id}}">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete participant</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        Are you sure to delete this participant?
                                      </div>
                                      <div class="modal-footer">

                                        <form style="display:inline" method="POST" action="{{route('participantes.destroy',$participante->id)}}">
                                                {!!method_field('DELETE')!!}
                                                {!!csrf_field()!!}
                                                <button class="btn btn-danger" type="submit">Delete</button>                 
                                        </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div id="actualizarModal{{$participante->id}}" class="modal fade" role="dialog">
                              <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4>Update participant</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                    <div class="text-left">
                                    <form method="POST" action="{{ route('participantes.update', $participante->id) }}">
                                        {!!method_field('PUT')!!}
                                        {!!csrf_field()!!}  
                                  <div class="modal-body" id="contenedorDeModalActualizar{{$participante->id}}">
                                  </div>
                                  <div class="modal-footer">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade stick-up UpdateYesNoModal{{$participante->id}}" tabindex="-1" role="dialog" aria-labelledby="UpdateYesNoModal{{$participante->id}}" id="UpdateYesNoModal{{$participante->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 id="messageBox2" class="modal-title">Confirm update participant</h4>
                                        </div>
                                        <div class="modal-body" style="font-weight: normal;">
                                            Are you sure to update this participant?
                                        </div>
                                        <div class="modal-footer" style="text-align: center !important">
                                            <input  data-toggle="modal" class="btn btn-info" type="submit" value="Proceed" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </form>
					</td>
				</tr>
				@endforeach
            </tbody>
        </table>
    </div>


    <!-- modal de show-->
    <div class="modal fade" id="showModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Show participant </h4>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Choose an event first</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-weight: normal;">
                To be able to update an attendance you must first select an event
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(function() {
        selecionadoActualizar = function(id){
            fetch(`/participantes/`+id+`/edit`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedorDeModalActualizar"+id).innerHTML = html ;
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
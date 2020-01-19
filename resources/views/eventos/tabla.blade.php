
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>    
                        <th>ID</th>                        
                        <th>Nombre</th>
                        <th>tipo</th>
                        <th>fecha de inicio</th>
                        <th>fecha de fin </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($eventos_lista as $evento)
					<tr>

						<td>{{$evento->id}}</td>
						<td>
							<a onclick="selecionadoShow({{$evento->id}})" data-toggle="modal" data-target="#showModal" type="button"  >
                                {{$evento->nombre}}
                        	</a>
						</td>         
                        <td>
                        	<a onclick="selecionadoShow({{$evento->id}})" data-toggle="modal" data-target="#showModal" type="button"  >
                                {{$evento->tipo}}
                        	</a>
                        </td>
						<td>
							<a onclick="selecionadoShow({{$evento->id}})" data-toggle="modal" data-target="#showModal" type="button"  >
                                {{$evento->fecha_inicio}}
                        	</a>
						</td>
                        <td>
                        	<a onclick="selecionadoShow({{$evento->id}})" data-toggle="modal" data-target="#showModal" type="button"  >
                                {{$evento->fecha_fin}}
                        	</a>
                        </td>
						<td>
						<!-- BOTONES -->
                        <a data-toggle="modal" data-target="#actualizarModal" >
							<button class="btn btn-primary" onclick="selecionadoActualizar({{$evento->id}})">
                            Actualizar
                            </button>
						</a>
                        <a data-toggle="modal" data-target="#eliminarModal{{$evento->id}}">
                            <button class="btn btn-danger">
                            Eliminar
                            </button>
                        </a>
                        
                        <!-- MODALES-->
                        <div class="modal fade" id="eliminarModal{{$evento->id}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar evento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ¿Esta usted seguro que quiere eliminar este evento?
                                  </div>
                                  <div class="modal-footer">

                                    <form style="display:inline" method="POST" action="{{route('eventos.destroy',$evento->id)}}">
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
                    <h4>Actualizar información del evento</h4>
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
                    <h4>Información del evento</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body" id="contenedorDeModalShow">
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function() {
        selecionadoActualizar = function(id){
            fetch(`/eventos/`+id+`/edit`,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedorDeModalActualizar").innerHTML = html ;
                                    document.getElementById("texto").value = ""
             })
        }
        selecionadoShow = function(id){
            fetch(`/eventos/`+id,{ method:'get' })
            .then(response  =>  response.text() )
            .then(html      =>  {   document.getElementById("contenedorDeModalShow").innerHTML = html ;
                                    document.getElementById("texto").value = ""
             })
        }
    })
</script>
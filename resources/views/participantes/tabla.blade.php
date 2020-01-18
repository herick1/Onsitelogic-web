
       <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Asistencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($participantes_lista as $participante)
					<tr>

						<td>{{$participante->cedula}}</td>
						<td>
							<a href="{{route('participantes.show', $participante->id)}}" > 
								{{$participante->pimer_nombre}}
							</a>
						</td>         
                        <td>{{$participante->primer_apellido}}</td>
						<td>{{$participante->email}}</td>
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
                                    <button class="btn btn-success" style="width: 50px;">
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
                                    <button class="btn btn-danger" style="width: 50px;">
                                    No
                                    </button>
                                @endif
                            @endif					
						</td>
						<td>
							<!-- BOTONES -->
                            <a href="{{route('participantes.edit', $participante->id)}}">
								<button class="btn btn-primary">
                                Actualizar
                                </button>
							</a>
                            <a data-toggle="modal" data-target="#eliminarModal">
                                <button class="btn btn-danger">
                                Eliminar
                                </button>
                            </a>
                            
                            <!-- MODALES-->
                            <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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


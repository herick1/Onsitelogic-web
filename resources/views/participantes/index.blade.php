@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Participantes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href= "/participantes/create" class="btn btn-outline-info ml-4" role="button">
                Crear un Participante
            </a>
        </div>
      </div>
    </div>

        <form method="GET" class="form-inline ml-3">
            <div class="cntnr-padding" style="margin-bottom: 15px;margin-top:15px;">
                <div class="row">
                        <div class="input-group">
                          <input name="search" type="search" class="form-control" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                          </span>
                        </div>
                   <div class="col-md-8"></div>
                   <div class="col-md-8"></div>
               </div>
            </div>
            <div class="dropdown show">
                <a class="btn btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$eventosGet}}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach($eventos as $evento)
                        <a class="dropdown-item"  name="EventoGet" value="{{$evento->id}}" href= "{{ route('busquedaEvento',$evento->id)}}">{{$evento->nombre}}</a> 
                    @endforeach
                </div>
            </div>
        </form>  

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
							<a href="{{route('participantes.edit', $participante->id)}}">
								<button class="btn btn-primary">
                                Actualizar
                                </button>
							</a>
							<form style="display:inline" method="POST" action="{{route('participantes.destroy',$participante->id)}}">
								{!!method_field('DELETE')!!}
								{!!csrf_field()!!}
								<button class="btn btn-danger" type="submit">Eliminar</button>					
							</form>
						</td>
					</tr>
					@endforeach
                </tbody>
            </table>
        </div>
@stop;
@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Eventos</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href= "/eventos/create" class="btn btn-outline-info ml-4" role="button">
                Crear un evento
            </a>
        </div>
      </div>
    </div>

    <!--form action="{% url 'users:users_search' %}" method="GET" class="form-inline ml-3"-->
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
    </form>

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
					@foreach($participantes_lista as $participante)
					<tr>

						<td>{{$participante->id}}</td>
						<td>
							<a href="{{route('eventos.show', $participante->id)}}" > 
								{{$participante->pimer_nombre}}
							</a>
						</td>         
                        <td>{{$participante->primer_apellido}}</td>
						<td>{{$participante->fecha_de_nacimiento}}</td>
                        <td>{{$participante->fecha_de_nacimiento}}</td>
						<td>
							<a href="{{route('eventos.edit', $participante->id)}}">
								<button class="btn btn-primary">
                                Actualizar
                                </button>
							</a>
							<form style="display:inline" method="POST" action="{{route('eventos.destroy',$participante->id)}}">
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
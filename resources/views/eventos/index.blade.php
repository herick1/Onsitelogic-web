@extends('layout.layout')

@section('contenido')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Event</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a data-toggle="modal" data-target="#create" >
                <button class="btn btn-outline-info ml-4">
                    Create a event
                </button>
            </a>
        </div>
      </div>
    </div>
    <div class="col-8">
        <div class="input-group" style="width:400px;">
            <input type="text" class="form-control" id="texto" placeholder="Search for...">
            <div class="input-group-append"><span class="btn btn-primary">Search</span></div>
        </div>
    </div>
    <br>
    <br>

    <div id="contenedor" style="min-height: 400px">
            @include('eventos.tabla')
    </div>

    <!-- Modal -->
    <div id="create" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4>Create a new event</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
                <div class="text-left">
                <form method="POST" action="{{ route('eventos.store') }}">
                {!!csrf_field()!!}
                @include('eventos.create')
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade stick-up CreatenYesNoModal" tabindex="-1" role="dialog" aria-labelledby="CreatenYesNoModal" id="CreatenYesNoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="messageBox2" class="modal-title">Confirm create event</h4>
                </div>
                <div class="modal-body" style="font-weight: normal;">
                    Are you sure to create this event?
                </div>
                <div class="modal-footer" style="text-align: center !important">
                    <input  data-toggle="modal" class="btn btn-info" type="submit" value="Proceed" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</form>

@if($mensajeDeexito)
    <div class="modal fade" id="errores" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Has been {{$mensajeDeexito}} successfully</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-weight: normal;">
                The transaction made successfully {{$mensajeDeexito}} to the event
                <br>
                <img  src="{{asset('check_animado_correcto.gif')}}" style="max-height: 200px">
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">ok</button>
              </div>
            </div>
        </div>
    </div>
@endif


@if($errors->first('tipo') or $errors->first('nombre') or $errors->first('cantidad_de_personas') or $errors->first('fecha_inicio') or $errors->first('fecha_fin')  or $errors->first('parroquiaSelect') )
    <!-- modal de updateasistencia sin haber puesto un evento-->
    <div class="modal fade" id="errores" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ups the transaction could not be completed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-weight: normal;">
                The following errors were found during the transaction
                    <div class="alert alert-warning" role="alert">
                       @foreach ($errors->all() as $error)
                          <div>{{ $error }}</div>
                       @endforeach
                    </div>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>
@endif


    <script>         
        window.addEventListener('load',function(){
            document.getElementById("texto").addEventListener("keyup", () => {
                if((document.getElementById("texto").value.length)>=1)
                    fetch(`/evento/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                    .then(response  =>  response.text() )
                    .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
                //caso especial que estes borrando todo y quieres denuevo todos los registros de cualquier evento
                //a simple vista parece que es redundante este espacio de codigo pero si se agrega al de arriba 
                //ocurre un internal error
                if((document.getElementById("texto").value.length)==0)
                    fetch(`/evento/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                    .then(response  =>  response.text() )
                    .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
            })
        });
    </script>
    <script>
    $(document).ready(function(){
      // despues del código
                     $("#errores").modal("show");
    });
    </script>

@stop;
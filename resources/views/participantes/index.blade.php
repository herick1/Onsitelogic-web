@extends('layout.layout')

@section('contenido')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Participants</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a data-toggle="modal" data-target="#create" >
                <button class="btn btn-outline-info ml-4">
                    Create a participant
                </button>
            </a>
        </div>
      </div>
    </div>
    <div class="row">
        <div id="contenedorEvento">
            <select id="eventoSelect" class="form-control" onchange="selecionadounEvento()">

                <!-- caso de recargar la pagina y vienes de un update o un delete-->
                @if($eventoAntesSeleccionado)
                        <option Select value="{{$eventoAntesSeleccionado->id}}">{{$eventoAntesSeleccionado->nombre}}</option>
                    <optgroup label="options">
                        <option value="0">Select a event</option>
                @else
                    <option Select value="0">Select a event</option>
                @endif

                @foreach($eventos as $evento)
                    <option  value="{{$evento->id}}">{{$evento->nombre}}</option>
                @endforeach
                <!--para completar el gupo en caso de existir-->
                @if($eventoAntesSeleccionado)
                        </optgroup>
                @endif
            </select>
        </div>
        <b>
        <b>
        <b>
        <div class="col-8">
            <div class="input-group" style="width:400px;">
                <input type="text" class="form-control" id="texto" placeholder="Search for...">
                <div class="input-group-append"><span class="btn btn-primary">Search</span></div>
            </div>
        </div>
        <br>
        <br>
    </div>


<!-- Modal -->
<div class="text-left">
<form method="POST" action="{{ route('participantes.store') }}">
{!!csrf_field()!!}
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Create a new participant</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            @include('participantes.create')
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
                    <h4 id="messageBox2" class="modal-title">Confirm create participant</h4>
                </div>
                <div class="modal-body" style="font-weight: normal;">
                    Are you sure to create this participant?
                </div>
                <div class="modal-footer" style="text-align: center !important">
                    <input  data-toggle="modal" class="btn btn-info" type="submit" value="Proceed" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>
        </div>
    </form>

    <div id="contenedor" style="min-height: 400px">
            @include('participantes.tabla')
    </div>


@if($errors->first('cedula') or $errors->first('primer_nombre') or $errors->first('segundo_nombre') or $errors->first('primer_apellido') or $errors->first('segundo_apellido')  or $errors->first('email') or $errors->first('fecha_de_nacimiento')  or $errors->first('telefono') or $errors->first('tipo') or $errors->first('parroquiaSelect') )
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
                The following errors were found during the transaction:
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
                The transaction {{$mensajeDeexito}} a participant successfully.
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


    <script>         
        window.addEventListener('load',function(){
            document.getElementById("texto").addEventListener("keyup", () => {
                if((document.getElementById("texto").value.length)>=1)
                    fetch(`/nombre/buscador?texto=${document.getElementById("texto").value}&evento=${document.getElementById("eventoSelect").value}`,{ method:'get' })
                    .then(response  =>  response.text() )
                    .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
                //caso especial que estes borrando todo y quieres denuevo todos los registros de cualquier evento
                //a simple vista parece que es redundante este espacio de codigo pero si se agrega al de arriba 
                //ocurre un internal error
                if((document.getElementById("texto").value.length)==0)
                    fetch(`/nombre/buscador?texto=${document.getElementById("texto").value}&evento=${document.getElementById("eventoSelect").value}`,{ method:'get' })
                    .then(response  =>  response.text() )
                    .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
            })
        });
    </script>
    <script type="text/javascript">
    $(function() {
        selecionadounEvento = function(){
            fetch(`/busquedaEvento/${document.getElementById("eventoSelect").value}`,{ method:'get' })
            .then(response  =>  response.text() )
                    .then(html      =>  {   document.getElementById("contenedor").innerHTML = html ;
                                            document.getElementById("texto").value = ""
                     })
        }

        //necesario para podr mover el primer modal despues de tener un segundo modal
        $('.modal').on('hidden.bs.modal', function () {
        //If there are any visible
          if($(".modal:visible").length > 0) {
              //Slap the class on it (wait a moment for things to settle)
              setTimeout(function() {
                  $('body').addClass('modal-open');

              },100)
          }
        });
    })
    </script>
    <script>
    $(document).ready(function(){
      // despues del código
        $("#errores").modal("show");
    });
    </script>
@stop;
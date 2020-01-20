@extends('layout.layout')

@section('contenido')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Evento</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a data-toggle="modal" data-target="#create" >
                <button class="btn btn-outline-info ml-4">
                    Crear un evento
                </button>
            </a>
        </div>
      </div>
    </div>
    <div class="col-8">
        <div class="input-group" style="width:400px;">
            <input type="text" class="form-control" id="texto" placeholder="Buscar por">
            <div class="input-group-append"><span class="btn btn-primary">Buscar</span></div>
        </div>
    </div>
    <br>
    <br>

    <div id="contenedor" style="min-height: 400px">
            @include('eventos.tabla')
    </div>

    <!-- modales  -->
    <div class="modal fade" id="create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Crear un nuevo evento</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('eventos.create')
                </div>
            </div>
        </div>
    </div>

@if($mensajeDeexito)
    <div class="modal fade" id="errores" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Se a {{$mensajeDeexito}} satifactoriamente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-weight: normal;">
                La transacción realizada a {{$mensajeDeexito}} correctamente al evento
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
@extends('layout.layout')

@section('contenido')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Participantes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a data-toggle="modal" data-target="#create" >
                <button class="btn btn-outline-info ml-4">
                    Crear un participante
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
                    <optgroup label="opciones">
                        <option value="0">Seleccione un evento</option>
                @else
                    <option Select value="0">Seleccione un evento</option>
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
                <input type="text" class="form-control" id="texto" placeholder="Buscar por">
                <div class="input-group-append"><span class="btn btn-primary">Buscar</span></div>
            </div>
        </div>
        <br>
        <br>
    </div>

    <div id="contenedor">
            @include('participantes.tabla')
    </div>


    <!-- modales  -->
    <div class="modal fade" id="create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Crear un nuevo participante</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('participantes.create')
                </div>
            </div>
        </div>
    </div>


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
    })
    </script>

@stop;
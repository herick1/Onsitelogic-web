@extends('layout.layout')

@section('contenido')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Participantes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a data-toggle="modal" data-target="#create" class="btn btn-outline-info ml-4" role="button">
                Crear un Participante
            </a>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="dropdown show">
            <a class="btn btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input name="probando" id="probando" value="1" class="d-none"></input>{{$eventosGet}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @foreach($eventos as $evento)
                    <a class="dropdown-item"  name="EventoGet" value="{{$evento->id}}" href= "{{ route('busquedaEvento',$evento->id)}}">{{$evento->nombre}}</a> 
                @endforeach
            </div>
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



<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                <h4>Crear</h4>
            </div>
            <div class="modal-body">
                @include('participantes.create')
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </div>
    </div>
</div>


        <script>         
            window.addEventListener('load',function(){
                document.getElementById("texto").addEventListener("keyup", () => {
                    if((document.getElementById("texto").value.length)>=1)
                        fetch(`/nombre/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                        .then(response  =>  response.text() )
                        .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
                })
            });
        </script>

@stop;
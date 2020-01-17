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
        <div id="resultados"></div>
        <div id="contenedor">
            @include('participantes.tabla')
    </div>

        <script>         
            window.addEventListener('load',function(){
                document.getElementById("texto").addEventListener("keyup", () => {
                    if((document.getElementById("texto").value.length)>=1)
                        fetch(`/nombre/buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                        .then(response  =>  response.text() )
                        .then(html      =>  {   document.getElementById("contenedor").innerHTML = html  })
                    else
                        document.getElementById("contenedor").innerHTML = ""
                })
            });
        </script>

@stop;

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

		<link rel="stylesheet" href="{{asset('css/layout.css')}}">

		<script src="http://code.jquery.com/jquery-latest.js"></script>

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>


    <header>
		<div class="wrapper">
			 <a href= "{{ route('home') }}"><div class="logo">Onsitelogic Web</div></a>
			
			<nav>
				<!-- este if con el request es para que el boton este seleccinado en la pagina donde estas
				para hacerlo mas dinamico , y la referencia es al link no al archivo blade eso se encarga el pageController -->
				<a class="{{ request() ->is('/')? 'active' :'' }}" href= "{{ route('home') }}">Inicio</a>
			</nav>
		</div>
	</header>
		<!-- esto porque aqui debajo iria el contenido de la pagina sin afectar el layout-->
		@yield('contenido');
		<footer> Copyright ° Herick  {{ date('Y') }}</footer>
    </body>
</html>
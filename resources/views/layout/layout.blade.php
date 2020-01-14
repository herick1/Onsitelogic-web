
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
        <header>
		<div class="wrapper">
			<div class="logo">Onsitelogic Web</div>
			
			<nav>
				<!-- este if con el request es para que el boton este seleccinado en la pagina donde estas
				para hacerlo mas dinamico , y la referencia es al link no al archivo blade eso se encarga el pageController -->
				<a class="{{ request() ->is('/')? 'active' :'' }}" href= "{{ route('home') }}">Inicio</a>
			</nav>
		</div>
	</header>
		<!-- esto porque aqui debajo iria el contenido de la pagina sin afectar el layout-->
		@yield('contenido');
		<footer> Copyright ° herick  {{ date('Y') }}</footer>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="generator" content="Jekyll v3.8.6">
		<title>OnsiteLogic</title>
		<link rel="icon" href="https://i0.wp.com/raw.githubusercontent.com/ServiceStack/Assets/master/img/livedemos/techstacks/django-logo.png?resize=450%2C450&ssl=1&crop=1">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="{{asset('static/bootstrap.min.css')}}">

		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="{{asset('static/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('static/sweetalert.min.js')}}"></script>
		    

		<style type="text/css">/* Chart.js */
		    @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
		</style>
	</head>

	<body style="padding-top:2.5rem! important">

		<nav class="navbar navbar-dark fixed-top bg-info shadow ">
		  <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="/">OnsiteLogic proyect</a>
		  <ul class="navbar-nav px-3">
		    <li class="nav-item text-nowrap">
		      <a class="nav-link text-white" href= "{{ route('home') }}">Home</a>
		    </li>
		  </ul>
		</nav>
		<div class="container-fluid text-center">
		  <div class="row">
			    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
			      	<div class="sidebar-sticky">
				        <ul class="nav flex-column">
				            <li class="nav-item">
				              <a class="nav-link" href= "{{ route('home') }}">
				                <span data-feather="users"></span>
				                Persons
				              </a>
				            </li>
				            <li class="nav-item">
				              <a class="nav-link" href= "{{ route('evento') }}">
				                <span data-feather="file"></span>
				                Events
				              </a>
				            </li>
				        </ul>       
	      			</div>
	    		</nav>
			    <main role="main" style="padding-top:0px;"class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute;  overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>

					@yield('contenido')
					<br>
					<br>
					<footer> Copyright ° Herick  {{ date('Y') }}</footer>
			    </main>
		  	</div>
		</div>
      	<script src="{{asset('static/jquery-3.4.1.slim.min.js')}}"></script>
      	<script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      	<script src="{{asset('static/bootstrap.bundle.min.js')}}"></script>
      	<script src="{{asset('static/feather.min.js')}}"></script>
      	<script src="{{asset('static/dashboard.js')}}"></script>
	</body>
</html>
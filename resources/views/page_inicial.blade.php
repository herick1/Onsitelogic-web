@extends('layout.layout')
@section('contenido')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<link rel="stylesheet" href="./css/reset.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="./css/main.css">
	<title>Formulario</title>
	        <!-- Styles -->
        <style>
        	html {
	font-size: 16px;
    font-family: 'Lato', sans-serif;
}


.container {
	max-width: 450px;
	height: auto;
	background-color: #EFEFEF;
	margin: 5% auto;
	padding-bottom: 1rem;
	
}

.form__top {
	width: 100%;
	text-align: center;
	padding: 2rem 0 1rem;
	border-top: solid .4rem #F39B53;
	margin-bottom: 1rem;
}

.form__top h2 {
	font-weight: bold;
	color: #CAC8C8;
	font-size: 18px;
}

h2 span {
	color: #F39B53;
}

.form__reg {
	padding: 0 2rem;
	display: flex;
	flex-direction: column;
	justify-content: center;
}

.btn__form {
	display: flex;
	justify-content: space-around;
	margin-top: 1rem;
}

.input, .btn__submit, .btn__reset{
	background-color: #EFEFEF;
	padding: .5rem;
	margin: .5rem 0;
	border: none;
	border-bottom: solid #C8C8C8 .2rem;
	transition: all .5s;
}

.input:focus {
	border-bottom: solid #F39B53 .2rem;
}

.btn__submit, .btn__reset {
	width: 40%;
	border-bottom: none;
	background-color: #31B1E5;
	color: white;
}

.btn__reset {
	background-color: #EDA135;
}

.btn__submit:hover {
	background-color: #4C9ED9;
}

.btn__reset:hover{
	background-color: #FA9535;
}

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}



        </style>
</head>
<body>

	<div class="container">
		<div class="form__top">
			<h2>Formulario <span>Registro</span></h2>
		</div>		
		<form class="form__reg" method="POST" action="contacto">
			<!-- esto dell token es para poder pasar por los middelware ya que en caso contraio daria la execpcion
				ya que no es un token valido y no podrias pasar al siguiente request , hay dos formas de hacerlo :
            1)<input name="_token" type="hidden" value= "{{ csrf_token() }}" 
            2) --> 
            {!!csrf_field()!!}

			<input class="input" name="nombre" type="text" placeholder="&#128100;  Nombre" required autofocus>
            <input class="input" name="email" type="email" placeholder="&#9993;  Email" required>
            <input class="input" name="telefono" type="text" placeholder="&#128222;  Telefono" required>
            <input class="input" name="direccion" type="text" placeholder="&#8962;  Dirección" required>
            <input class="input" name="mensaje" type="text" placeholder="&#8962;  Mensaje" required>
            <div class="btn__form">
            	<input class="btn__submit" type="submit" value="ENVIAR">
            	<input class="btn__reset" type="reset" value="LIMPIAR">	
            </div>
		</form>
	</div>
	
</body>
</html>
@stop
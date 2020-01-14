<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMessageRequest;


class PagesController extends Controller
{
	protected $request;

	//aqui en el constructur agregaos tanto el request como el 
	//middleware para poder acceder a la rutas que no sean de tipo get
	public function __construct(Request $requests)
	{
			$this->request = $requests;
			// esto se aplica para todas as url 
			//$this->middleware('TokenAuthenticated'); pero para 
			//ponerlo a solo uuna se hace de la siguient forma
			$this->middleware('TokenAuthenticated', ['only'=> ['contacto']]);
			//tambien esta la version opuesta al unico sino , que se aplican a todos excepto tan url y se hace : 
			//$this->middleware('TokenAuthenticated', ['except'=> ['contacto']]);
	}
    /*
	| primero se crea una direcciones que rediriguen a la pagina de contactos 
	| 	echo "<a href= " + route('contactos') +"/> Contactos <br>";
	| route('link') sirve en laravel para redirigir a un nombre de alguna pagina dentro del sitio
	| recordar que para concatenar es con punto en vez de con el mas
	*/
    //	echo "<a href= " . route('contactos') ."> Contactos </a><br>";
    public function home(){
    	return view('page_inicial');	
    } 

 	public function servicios($nombre = 'Invitado') {
    	return view ('home',compact ('nombre'));
	}
    public function proyectos($nombre = 'Invitado'){
    	return view ('home',compact ('nombre'));	
    }
	public function contactos(){
    	return view('contactos');	
    }
    public function contacto(CreateMessageRequest $formRequest){	

    	// aui utilizamos la clase de validaciones de reqquest 
    	$data =$formRequest->all();
    	return redirect()->route('contactos');
    	//en vez de retornar una url podemos hacer es
    	// return back();

    	// esto es para mandar una respuesta con un estado 
    	//return response->json(['data' => $data] , 200);
    
    }
}

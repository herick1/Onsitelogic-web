<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


Route::get('/', [ 'as' => 'home' , 'uses'=> 'ParticipanteController@index' ]);

Route::resource('participantes', 'ParticipanteController');

Route::get('/evento', [ 'as' => 'evento' , 'uses'=> 'EventoController@index' ]);

Route::resource('eventos', 'EventoController');

Route::get('busquedaEvento/{idEvento?}', ['as' => 'busquedaEvento', 'uses'=> 'ParticipanteController@busquedaEvento'])->where('idEvento' , "[0-9]+");

Route::post('UpdateAsistencia/{id?}/{asistencia?}', ['as' => 'UpdateAsistencia', 'uses'=> 'ParticipanteController@UpdateAsistencia'])->where('id' , "[0-9]+")->where('asistencia' , "[0-1]+");

//este get solo es necesario porque si ocurre una eventualidad con el post el puede agarrar el router get y devolverte a la vista inicial sin que se explote la aplicacion
Route::get('UpdateAsistencia/{id?}/{asistencia?}', 'ParticipanteController@index');

//revisar si este todovaia se utiliza sino borrarlo
Route::get('buscador', ['as' => 'buscador', 'uses'=> 'ParticipanteController@buscador']);

// RUTA PARA EL BUSCADOR EN TIEMPO REAL
Route::get('/nombre/buscador','ParticipanteController@buscador');


// RUTA PARA EL BUSCADOR EN TIEMPO REAL
Route::get('/evento/buscador','EventoController@buscador');


// RUTA PARA EL BUSCADOR EN TIEMPO REAL
Route::get('/lugar/buscadorMunicipio','LugarController@buscadorMunicipio');

Route::get('/lugar/buscadorParroquia','LugarController@buscadorParroquia');
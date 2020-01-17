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

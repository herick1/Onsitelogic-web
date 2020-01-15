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


Route::get('/', function () {
    return view('page_inicial');
});


Route::get('/', [ 'as' => 'home' , 'uses'=> 'ParticipanteController@index' ]);

Route::resource('participantes', 'ParticipanteController');


//Route::get('/evento', [ 'as' => 'home' , 'uses'=> 'EventoController' ]);
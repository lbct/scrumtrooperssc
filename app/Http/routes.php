<?php
use \App\Usuario;
use \App\Administrador;
use \App\Docente;
use \App\Auxiliar;
use \App\Estudiante;
use \App\IniciarSesion;
use \App\AsignaRol;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function(){
    echo 'Welcome Home';
});

Route::get('test', function(){
    $usuario = Usuario::find(1)->asignaRol->rol->asignaFuncion[0]->funcion->asignaFuncion[0]->rol->asignaRol[0]->usuario;
    
    echo $usuario;
    echo 'Welcome Home';
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


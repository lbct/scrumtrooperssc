<?php
use \App\Usuario;
use \App\Administrador;
use \App\Docente;
use \App\Auxiliar;
use \App\Estudiante;
use \App\IniciarSesion;
use \App\AsignaRol;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function(){
    echo 'Welcome Home';
});

Route::get('registro', 'RegistroEstudianteController@getRegistro');
Route::post('registro', 'RegistroEstudianteController@postRegistro');

Route::get('login', 'IngresoUsuarioController@getLogin');
Route::post('login', 'IngresoUsuarioController@postLogin');
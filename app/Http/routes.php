<?php
use \App\Usuario;
use \App\Administrador;
use \App\Docente;
use \App\Auxiliar;
use \App\Estudiante;
use \App\IniciarSesion;
use \App\AsignaRol;

Route::get('auth/register', function(){
    return View('auth/register');
});

//Ruta Inicial Login
Route::get('/', 'IngresoUsuarioController@getLogin');

Route::get('login', 'IngresoUsuarioController@getLogin');
Route::post('login', 'IngresoUsuarioController@postLogin');
Route::get('logout', 'IngresoUsuarioController@getLogout');

//Rutas Estudiante
Route::get('estudiante','Estudiante\Control@getVista');
Route::get('estudiante/editar','Estudiante\Control@getEdit');
Route::post('estudiante/editar','Estudiante\Control@postEdit');
Route::get('registro', 'Estudiante\Registro@getRegistro');
Route::post('registro', 'Estudiante\Registro@postRegistro');

//Rutas Admin
Route::get('administrador',[
    'as' => 'administrador',
    'uses' => 'Admin\Control@getVista'
    ]);

Route::get('administrador/crearDocente','Admin\Docente\Control@getCrear');
Route::post('administrador/crearDocente','Admin\Docente\Control@postCrear');

Route::get('administrador/listaDocente','Admin\Docente\Control@getLista');  //Mostrar lista de docentes registrados

Route::get('administrador/editarDocente/{id_usuario}',
[
    'as' => 'administrador/editarDocente',
    'uses' => 'Admin\Docente\Control@getEdit'
]);


Route::post('administrador/editarDocente/{id_usuario}',
[
    'as' => 'administrador/editarDocente',
    'uses' => 'Admin\Docente\Control@postEdit'
]);

Route::get('administrador/crearAdmin','Admin\Control@getCrear');
Route::post('administrador/crearAdmin','Admin\Control@postCrear');

Route::get('administrador/crearGestion','Admin\Gestion\Control@getCrear');
Route::post('administrador/crearGestion','Admin\Gestion\Control@postCrear');

//Rutas Auxiliar
//Route::get('auxiliar','');

//Rutas Docente
Route::get('docente','Docente\Control@getVista');

Route::get('docente/crearAuxiliar','Docente\Control@getCrearAuxiliar');
Route::post('docente/crearAuxiliar','Docente\Control@postCrearAuxiliar');


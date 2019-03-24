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
Route::get('administrador','Admin\Control@getVista');

Route::get('administrador/crearDocente','Admin\Docente\Control@getCuentaDocente');
Route::post('administrador/crearDocente','Admin\Docente\Control@postCuentaDocente');

Route::get('administrador/listaDocente','Admin\Docente\Control@getLista');  //Mostrar lista de docentes registrados

Route::get('administrador/editarDocente','Admin\Docente\Control@editCuenta');
Route::post('administrador/editarDocente','Admin\Docente\Control@postCuenta');

Route::get('administrador/crearAdmin','Admin\Control@getCuentaAdmin');
Route::post('administrador/crearAdmin','Admin\Control@postCuentaAdmin');

Route::get('administrador/crearGestion','Admin\Control@getGestion');
Route::post('administrador/crearGestion','Admin\Control@postGestion');

//Rutas Auxiliar
//Route::get('auxiliar','');

//Rutas Docente
Route::get('docente','Docente\Control@getVista');

Route::get('docente/crearAuxiliar','Docente\Control@getCuentaAuxiliar');
Route::post('docente/crearAuxiliar','Docente\Control@postCuentaAuxiliar');


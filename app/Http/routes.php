<?php
use \App\Models\Docente;

Route::get('test', function () {
    $clases = Docente::all();
    return $clases[0]->grupoADocente;
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
Route::get('estudiante/inscripcion', 'Estudiante\Inscripcion@getVista');
Route::post('estudiante/inscripcion', 'Estudiante\Inscripcion@postInscripcion');
Route::get('estudiante/estadoInscripcion', 'Estudiante\EstadoInscripcion@getLista');


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
Route::get('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Control@getEditarClave');
Route::post('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Control@postEditarClave');

Route::get('administrador/crearAdmin','Admin\Control@getCrear');
Route::post('administrador/crearAdmin','Admin\Control@postCrear');

Route::get('administrador/crearGestion','Admin\Gestion\Control@getCrear');
Route::post('administrador/crearGestion','Admin\Gestion\Control@postCrear');

Route::get('administrador/verDocente/{id_usuario}',
[
    'as' => 'administrador/verDocente',
    'uses' => 'Admin\Docente\Control@getVistaSimple'
]);

//Rutas Auxiliar
Route::get('auxiliar','Auxiliar\Control@getVista');
Route::get('auxiliar/clases/{id_gestion}', 
[
    'as' => 'auxiliar/clases',
    'uses' => 'Auxiliar\Control@getClases'
]);
Route::get('auxiliar/clases', 'Auxiliar\Control@getUltimaClase');
Route::post('auxiliar/clases', 
[
    'as'   => 'auxiliar/clases',
    'uses' => 'Auxiliar\Control@postClases'
]);

//Rutas Docente
Route::get('docente','Docente\Control@getVista');
Route::get('docente/editar', 'Docente\Control@getEditar');
Route::post('docente/editar', 'Docente\Control@postEditar');
Route::get('docente/crearAuxiliar','Docente\Control@getCrearAuxiliar');
Route::post('docente/crearAuxiliar','Docente\Control@postCrearAuxiliar');


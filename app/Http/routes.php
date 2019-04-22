<?php
use \App\Models\Docente;

Route::get('test', function () {
    $clases = Docente::all();
    return $clases[0]->grupoADocente;
});

//Ruta Inicial Login
Route::get('/', 'Sesion\Control@getLogin');

Route::get('login', 'Sesion\Control@getLogin');
Route::post('login', 'Sesion\Control@postLogin');
Route::get('logout', 'Sesion\Control@getLogout');

//Rutas Estudiante
Route::get('estudiante','Estudiante\Inicio\Control@getInicio');
Route::get('estudiante/editar','Estudiante\Editar\Control@getEditar');
Route::post('estudiante/editar','Estudiante\Editar\Control@postEditar');
Route::get('registro', 'Estudiante\Crear\Control@getRegistro');
Route::post('registro', 'Estudiante\Crear\Control@postRegistro');
Route::get('estudiante/inscripcion', 'Estudiante\Inscribir\Control@getInscripcion');
Route::post('estudiante/inscripcion', 'Estudiante\Inscribir\Control@postInscripcion');
Route::get('estudiante/estadoInscripcion', 'Estudiante\Ver\Control@getMaterias');

Route::get('estudiante/clases/{id_sesion}',[
    'as' => 'estudiante',
    'uses' => 'Estudiante\Subir\Control@getSubir'
]);

Route::post('estudiante/clases/{id_sesion}',[
    'as' => 'estudiante',
    'uses' => 'Estudiante\Subir\Control@postSubir'
]);

//Rutas Admin
Route::get('administrador',[
    'as' => 'administrador',
    'uses' => 'Admin\Inicio\Control@getInicio'
]);

Route::get('administrador/crearDocente','Admin\Docente\Crear\Control@getRegistro');
Route::post('administrador/crearDocente','Admin\Docente\Crear\Control@postRegistro');

Route::get('administrador/listaDocente','Admin\Docente\Ver\Control@getLista');  //Mostrar lista de docentes registrados

Route::get('administrador/editarDocente/{id_usuario}',
[
    'as' => 'administrador/editarDocente',
    'uses' => 'Admin\Docente\Editar\Control@getUsuario'
]);

Route::post('administrador/editarDocente/{id_usuario}',
[
    'as' => 'administrador/editarDocente',
    'uses' => 'Admin\Docente\Editar\Control@postUsuario'
]);
Route::get('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Editar\Control@getClave');
Route::post('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Editar\Control@postClave');

Route::get('administrador/crearAdmin','Admin\Crear\Control@getRegistro');
Route::post('administrador/crearAdmin','Admin\Crear\Control@postRegistro');

Route::get('administrador/crearGestion','Admin\Gestion\Crear\Control@getRegistro');
Route::post('administrador/crearGestion','Admin\Gestion\Crear\Control@postRegistro');

Route::get('administrador/verDocente/{id_usuario}',
[
    'as' => 'administrador/verDocente',
    'uses' => 'Admin\Docente\Ver\Control@getUsuario'
]);

//Rutas Auxiliar
Route::get('auxiliar','Auxiliar\Inicio\Control@getInicio');
Route::get('auxiliar/clases/{id_gestion}', 
[
    'as' => 'auxiliar/clases',
    'uses' => 'Auxiliar\Ver\Control@getClases'
]);
Route::get('auxiliar/clases', 'Auxiliar\Ver\Control@getClasesUltimaGestion');
Route::post('auxiliar/clases', 
[
    'as'   => 'auxiliar/clases',
    'uses' => 'Auxiliar\Ver\Control@postClases'
]);

//Rutas Docente
Route::get('docente','Docente\Inicio\Control@getInicio');
Route::get('docente/editar', 'Docente\Editar\Control@getEditar');
Route::post('docente/editar', 'Docente\Editar\Control@postEditar');
Route::get('docente/crearAuxiliar','Docente\Auxiliar\Crear\Control@getRegistro');
Route::post('docente/crearAuxiliar','Docente\Auxiliar\Crear\Control@postRegistro');


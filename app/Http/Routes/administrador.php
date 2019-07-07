<?php
//Rutas Administrador
Route::get('administrador/gestiones', 'Administrador\Gestion\Control@todas');
Route::post('administrador/gestion', 'Administrador\Gestion\Control@agregar');
Route::put('administrador/gestion', 'Administrador\Gestion\Control@editar');
Route::delete('administrador/gestion', 'Administrador\Gestion\Control@borrar');
Route::put('administrador/gestion/activa', 'Administrador\Gestion\Control@cambiarActiva');

Route::get('administrador/periodos/{anho_gestions}', 'Administrador\Periodo\Control@disponibles');

Route::get('administrador/fechas/inscripcion', 'Administrador\FechasInscripcion\Control@todas');
Route::post('administrador/fechas/inscripcion', 'Administrador\FechasInscripcion\Control@agregar');
Route::delete('administrador/fechas/inscripcion', 'Administrador\FechasInscripcion\Control@borrar');

Route::get('administrador/aulas', 'Administrador\Aula\Control@todas');
Route::post('administrador/aula', 'Administrador\Aula\Control@agregar');
Route::put('administrador/aula', 'Administrador\Aula\Control@editar');
Route::delete('administrador/aula', 'Administrador\Aula\Control@borrar');

Route::get('administrador/materia/{gestion_id}', 'Administrador\Materia\Control@todas');
Route::post('administrador/materia', 'Administrador\Materia\Control@agregar');
Route::put('administrador/materia', 'Administrador\Materia\Control@editar');
Route::delete('administrador/materia', 'Administrador\Materia\Control@borrar');

Route::get('administrador/docentes/disponibles/{materia_id}', 'Administrador\GrupoDocente\Control@docentesDisponibles');

Route::get('administrador/gruposdocentes/{materia_id}', 'Administrador\GrupoDocente\Control@todos');
Route::get('administrador/grupodocente/{grupo_docente_id}', 'Administrador\GrupoDocente\Control@informacion');
Route::post('administrador/grupodocente', 'Administrador\GrupoDocente\Control@agregarGrupoDocente');
Route::delete('administrador/grupodocente', 'Administrador\GrupoDocente\Control@borrarGrupoDocente');

Route::post('administrador/grupodocente/docente', 'Administrador\GrupoDocente\Control@agregarDocente');
Route::delete('administrador/grupodocente/docente', 'Administrador\GrupoDocente\Control@retirarDocente');
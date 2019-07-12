<?php
//Rutas Administrador
Route::get('administrador/gestiones', 'Administrador\Gestion\Control@todas');
Route::post('administrador/gestion', 'Administrador\Gestion\Control@agregar');
Route::put('administrador/gestion', 'Administrador\Gestion\Control@editar');
Route::delete('administrador/gestion', 'Administrador\Gestion\Control@borrar');
Route::put('administrador/gestion/activa', 'Administrador\Gestion\Control@cambiarActiva');

Route::get('administrador/periodos/{anho_gestions}', 'Administrador\Periodo\Control@disponibles');

Route::get('administrador/fechasinscripcion', 'Administrador\FechasInscripcion\Control@todas');
Route::post('administrador/fechasinscripcion', 'Administrador\FechasInscripcion\Control@agregar');
Route::delete('administrador/fechasinscripcion', 'Administrador\FechasInscripcion\Control@borrar');

Route::get('administrador/aulas', 'Administrador\Aula\Control@todas');
Route::post('administrador/aula', 'Administrador\Aula\Control@agregar');
Route::put('administrador/aula', 'Administrador\Aula\Control@editar');
Route::delete('administrador/aula', 'Administrador\Aula\Control@borrar');

Route::get('administrador/materias/{gestion_id}', 'Administrador\Materia\Control@todas');
Route::post('administrador/materia', 'Administrador\Materia\Control@agregar');
Route::put('administrador/materia', 'Administrador\Materia\Control@editar');
Route::delete('administrador/materia', 'Administrador\Materia\Control@borrar');

Route::get('administrador/docentes/disponibles/{materia_id}', 'Administrador\GrupoDocente\Control@docentesDisponibles');

Route::get('administrador/gruposdocentes/{materia_id}', 'Administrador\GrupoDocente\Control@todos');
Route::get('administrador/grupodocente/{grupo_docente_id}', 'Administrador\GrupoDocente\Control@informacion');
Route::get('administrador/grupodocente/docentes/{grupo_docente_id}', 'Administrador\GrupoDocente\Control@docentes');
Route::post('administrador/grupodocente', 'Administrador\GrupoDocente\Control@agregarGrupoDocente');
Route::put('administrador/grupodocente', 'Administrador\GrupoDocente\Control@editarGrupoDocente');
Route::delete('administrador/grupodocente', 'Administrador\GrupoDocente\Control@borrarGrupoDocente');

Route::get('administrador/clases/{grupo_docente_id}', 'Administrador\Clase\Control@todas');
Route::get('administrador/clases/disponibles/{gestion_id}/{horario_id}/{dia}', 'Administrador\Clase\Control@disponibles');
Route::post('administrador/clase', 'Administrador\Clase\Control@agregar');
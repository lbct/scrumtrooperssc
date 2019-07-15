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
Route::get('administrador/aulas/cantidad', 'Administrador\Aula\Control@cantidad');
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

Route::get('administrador/clases/{gestion_id}', 'Administrador\Clase\Control@todas');
Route::get('administrador/clases/disponibles/{gestion_id}/{horario_id}/{dia}', 'Administrador\Clase\Control@disponibles');
Route::post('administrador/clase', 'Administrador\Clase\Control@agregar');
Route::delete('administrador/clase', 'Administrador\Clase\Control@borrar');

Route::get('administrador/usuario/{usuario_id}', 'Administrador\Usuarios\Control@informacion');
Route::put('administrador/usuario', 'Administrador\Usuarios\Control@editar');
Route::put('administrador/usuario/password', 'Administrador\Usuarios\Control@editarPassword');
Route::delete('administrador/usuario', 'Administrador\Usuarios\Control@borrar');

Route::get('administrador/usuarios/administradores', 'Administrador\Usuarios\Administrador@todos');
Route::get('administrador/usuarios/docentes', 'Administrador\Usuarios\Docente@todos');
Route::get('administrador/usuarios/auxiliareslaboratorio', 'Administrador\Usuarios\AuxiliarLaboratorio@todos');
Route::get('administrador/usuarios/auxiliaresterminal', 'Administrador\Usuarios\AuxiliarTerminal@todos');
Route::get('administrador/usuarios/estudiantes', 'Administrador\Usuarios\Estudiante@todos');

Route::get('administrador/roles/usuario/disponibles/{usuario_id}', 'Administrador\Rol\Control@disponibles');
Route::put('administrador/rol/usuario', 'Administrador\Rol\Control@editar');
<?php
//Rutas Docente
Route::get('docente/gestiones', 'Docente\Gestion\Control@disponibles');

Route::get('docente/materias', 'Docente\Materia\Control@materias');
Route::get('docente/materias/{gestion_id}', 'Docente\Materia\Control@materiasGestion');

Route::get('docente/sesiones/{grupo_docente_id}', 'Docente\Sesion\Control@sesiones');
Route::post('docente/sesion', 'Docente\Sesion\Control@agregar');
Route::put('docente/sesion', 'Docente\Sesion\Control@editar');
Route::delete('docente/sesion', 'Docente\Sesion\Control@borrar');

Route::get('docente/clases/{gestion_id}', 'Docente\Clase\Control@clasesGestion');

Route::get('docente/auxiliares/disponibles/{grupo_docente_id}', 'Docente\Auxiliar\Control@disponibles');
Route::post('docente/auxiliares', 'Docente\Auxiliar\Control@asignar');
Route::get('docente/auxiliares/{gestion_id}', 'Docente\Auxiliar\Control@asignados');
Route::delete('docente/auxiliares', 'Docente\Auxiliar\Control@retirar');

Route::get('docente/estudiantes/{grupo_docente_id}', 'Docente\Estudiante\Control@estudiantes');
Route::get('docente/estudiante/{estudiante_clase_id}', 'Docente\Estudiante\Control@estudiante');
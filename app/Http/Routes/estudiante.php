<?php
//Rutas Estudiante
Route::get('estudiante/materias/inscritas', 'Estudiante\Materia\Control@inscritas');
Route::delete('estudiante/materias/inscritas', 'Estudiante\Materia\Control@retirar');
Route::get('estudiante/materias/disponibles', 'Estudiante\Materia\Control@materiasHabilitadas');
Route::get('estudiante/materia/{materia_id}/docentes', 'Estudiante\Materia\Control@docentesMateria');
Route::get('estudiante/materia/{grupo_a_docente_id}/clases', 'Estudiante\Materia\Control@clasesMateria');
Route::post('estudiante/materia', 'Estudiante\Materia\Control@nuevaMateria');

Route::get('estudiante/sesiones/{estudiante_clase_id}', 'Estudiante\Sesion\Control@cursadas');

Route::get('estudiante/practicas/{estudiante_clase_id}', 'Estudiante\Practica\Control@guias');
Route::post('estudiante/practica', 'Estudiante\Practica\Control@subir');
Route::delete('estudiante/practica', 'Estudiante\Practica\Control@borrar');
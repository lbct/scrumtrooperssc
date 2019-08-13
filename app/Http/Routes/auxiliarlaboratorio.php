<?php
//Rutas Auxiliar Laboratorio
Route::get('auxiliarlaboratorio/clases', 'AuxiliarLaboratorio\Clase\Control@disponibles');
Route::get('auxiliarlaboratorio/clase/{sesion_id}', 'AuxiliarLaboratorio\Clase\Control@informacion');

Route::get('auxiliarlaboratorio/sesion/estudiantes/{sesion_id}', 'AuxiliarLaboratorio\Sesion\Control@estudiantes');

Route::put('auxiliarlaboratorio/sesion/estudiante/asistencia', 'AuxiliarLaboratorio\SesionEstudiante\Control@cambiarAsistencia');
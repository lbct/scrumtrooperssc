<?php
//Rutas Auxiliar Terminal
Route::get('auxiliarterminal/materias', 'AuxiliarTerminal\Materia\Control@materias');
Route::get('auxiliarterminal/practicas/{grupo_docente_id}', 'AuxiliarTerminal\Practica\Control@descargables');

Route::get('auxiliarterminal/clases/{grupo_docente_id}', 'AuxiliarTerminal\Clase\Control@disponibles');
Route::get('auxiliarterminal/clase/{clase_id}', 'AuxiliarTerminal\Clase\Control@informacion');

Route::get('auxiliarterminal/sesion/{clase_id}', 'AuxiliarTerminal\Sesion\Control@disponibles');
Route::post('auxiliarterminal/sesion', 'AuxiliarTerminal\Sesion\Control@iniciarSesion');
Route::delete('auxiliarterminal/sesion', 'AuxiliarTerminal\Sesion\Control@detenerSesion');
Route::get('auxiliarterminal/sesion/estudiantes/{sesion_id}', 'AuxiliarTerminal\Sesion\Control@estudiantes');

Route::put('auxiliarterminal/sesion/estudiante/asistencia', 'AuxiliarTerminal\SesionEstudiante\Control@cambiarAsistencia');
Route::put('auxiliarterminal/sesion/estudiante/comentario', 'AuxiliarTerminal\SesionEstudiante\Control@cambiarComentario');

Route::get('auxiliarterminal/archivos/guia_practica/{guia_practica_id}', 'AuxiliarTerminal\GuiaPractica\Control@descargar');

Route::get('auxiliarterminal/estadisticas/gruposdocentes', 'AuxiliarTerminal\Estadistica\Control@gruposdocentes');
Route::get('auxiliarterminal/estadisticas/estudiantesinscritos', 'AuxiliarTerminal\Estadistica\Control@estudiantesinscritos');
Route::get('auxiliarterminal/estadisticas/cantidadclases', 'AuxiliarTerminal\Estadistica\Control@cantidadclases');
Route::get('auxiliarterminal/estadisticas/clasescursadas', 'AuxiliarTerminal\Estadistica\Control@clasescursadas');

Route::get('auxiliarterminal/estadisticas/enviospracticas/{grupo_docente_id}', 'AuxiliarTerminal\Estadistica\Control@enviospracticas');
Route::get('auxiliarterminal/estadisticas/asistencia/{grupo_docente_id}', 'AuxiliarTerminal\Estadistica\Control@asistencia');
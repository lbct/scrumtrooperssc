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

Route::get('docente/archivos/guia_practica/{guia_practica_id}', 'Docente\GuiaPractica\Control@descargar');

Route::get('docente/archivos/enviospracticas/{envio_practica_id}', 'Docente\EnvioPractica\Control@descargar');

Route::get('docente/estadisticas/gruposdocentes', 'Docente\Estadistica\Control@gruposdocentes');
Route::get('docente/estadisticas/guiaspracticas', 'Docente\Estadistica\Control@guiaspracticas');
Route::get('docente/estadisticas/estudiantesinscritos', 'Docente\Estadistica\Control@estudiantesinscritos');
Route::get('docente/estadisticas/enviostotales', 'Docente\Estadistica\Control@enviostotales');

Route::get('docente/estadisticas/enviospracticas/{grupo_docente_id}', 'Docente\Estadistica\Control@enviospracticas');
Route::get('docente/estadisticas/enviospracticas/grupo/{grupo_docente_id}', 'Docente\Estadistica\Control@enviospracticasgrupo');
Route::get('docente/estadisticas/enviospracticas/clase/{clase_id}', 'Docente\Estadistica\Control@enviospracticasclase');

Route::get('docente/estadisticas/asistencia/{grupo_docente_id}', 'Docente\Estadistica\Control@asistencia');
Route::get('docente/estadisticas/asistencia/grupo/{grupo_docente_id}', 'Docente\Estadistica\Control@asistenciagrupo');
Route::get('docente/estadisticas/asistencia/clase/{clase_id}', 'Docente\Estadistica\Control@asistenciaclase');

Route::get('docente/portafolios/{grupo_docente_id}', 'Docente\Portafolio\Control@descargar');
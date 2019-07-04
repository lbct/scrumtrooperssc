<?php
use \App\Models\Usuario;
use \App\Classes\Sesion;
use \App\Classes\Gestiones;
use \App\Classes\FechasInscripciones;
use Illuminate\Http\Request;

//Rutas Login
Route::get('/', 'Sesion\Control@getLogin');

Route::get('login', 'Sesion\Control@getLogin');
Route::post('login', 'Sesion\Control@postLogin');
Route::get('logout', 'Sesion\Control@getLogout');

//Rutas Panel
Route::get('/panel', function (Request $request) { 
    return view('test'); 
});

Route::get('/panel/{any}', function (Request $request) { 
    return view('test'); 
})->where('any', '^(.*)$');

//Ruta estado Inscripcion
Route::get('/inscripcion/activa', function (Request $request) {
    $activa = FechasInscripciones::fechaActiva();
    return response()->json(['activa'=>$activa], 200);
});

//Rutas Usuario
Route::get('usuario', 'Usuario\Control@informacion');
Route::put('usuario', 'Usuario\Control@editar');
Route::put('usuario/password', 'Usuario\Control@editarPassword');

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

//Rutas Docente
Route::get('docente/gestiones', 'Docente\Gestion\Control@disponibles');

Route::get('docente/materias', 'Docente\Materia\Control@materias');
Route::get('docente/materias/{gestion_id}', 'Docente\Materia\Control@materiasGestion');

Route::get('docente/sesiones/{grupo_docente_id}', 'Docente\Sesion\Control@sesiones');
Route::post('docente/sesion', 'Docente\Sesion\Control@agregar');

Route::get('docente/clases/{gestion_id}', 'Docente\Clase\Control@clasesGestion');

Route::get('docente/auxiliares/disponibles/{grupo_docente_id}', 'Docente\Auxiliar\Control@disponibles');
Route::post('docente/auxiliares', 'Docente\Auxiliar\Control@asignar');
Route::get('docente/auxiliares/{gestion_id}', 'Docente\Auxiliar\Control@asignados');
Route::delete('docente/auxiliares', 'Docente\Auxiliar\Control@retirar');

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
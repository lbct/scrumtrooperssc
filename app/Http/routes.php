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

//Rutas Docente
Route::get('docente/gestiones', 'Docente\Gestion\Control@disponibles');

Route::get('docente/materias', 'Docente\Materia\Control@materias');
Route::get('docente/materias/{gestion_id}', 'Docente\Materia\Control@materiasGestion');

Route::get('docente/clases/{gestion_id}', 'Docente\Clase\Control@clasesGestion');

Route::get('docente/auxiliares/disponibles/{grupo_docente_id}', 'Docente\Auxiliar\Control@disponibles');
Route::post('docente/auxiliares', 'Docente\Auxiliar\Control@asignar');
Route::get('docente/auxiliares/{gestion_id}', 'Docente\Auxiliar\Control@asignados');
Route::delete('docente/auxiliares', 'Docente\Auxiliar\Control@retirar');

//Rutas de Descarga 'uploads'
Route::get('descargar/guia/{filename}', function ($filename) {
    // Verfificar que el archivo exista en /uploads
    $file_path = (public_path() . "/uploads/guias practicas/" . $filename);

    if (file_exists($file_path)) {
        // Descarga
        return Response::download($file_path, $filename, [
            'Content-Length: ' . filesize($file_path)
        ]);
    } else {
        // Error
        return Redirect::back()->withErrors(['No se encontro el Archivo']);
    }
});
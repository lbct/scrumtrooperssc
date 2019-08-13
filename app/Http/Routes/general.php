<?php
use App\Models\Usuario;
use App\Classes\FechasInscripciones;
use Illuminate\Http\Request;

//Rutas Login
Route::get('/', 'Sesion\Control@getLogin');
Route::get('login', 'Sesion\Control@getLogin');
Route::post('login', 'Sesion\Control@postLogin');
Route::get('logout', 'Sesion\Control@getLogout');

//Rutas Panel
Route::get('panel', function (Request $request) { 
    return view('layout'); 
});

Route::get('panel/{any}', function (Request $request) { 
    return view('layout'); 
})->where('any', '^(.*)$');

//Ruta Estado Inscripcion
Route::get('inscripcion/activa', function (Request $request) {
    $activa = FechasInscripciones::fechaActiva();
    return response()->json(['activa'=>$activa], 200);
});

//Ruta Estado Edición de Inscripcion
Route::get('inscripcion/edicion/activa', function (Request $request) {
    $activa = FechasInscripciones::edicionInscripcion();
    return response()->json(['activa'=>$activa], 200);
});

//Ruta de Registro de Cuenta de Estudiante
Route::get('registro', 'Registro\Control@vista');
Route::post('registro', 'Registro\Control@registrar');

//Ruta de informacion About-Us
Route::get('about', function (Request $request){
    return view('about');
});

//Enviar Email con contraseña
Route::get('recuperarCuenta', 'Sesion\Control@getRecuperarCuenta');
Route::post('recuperarCuenta', 'Sesion\Control@enviarPassword');

//Rutas Usuario
Route::get('usuario', 'Usuario\Control@informacion');
Route::put('usuario', 'Usuario\Control@editar');
Route::put('usuario/password', 'Usuario\Control@editarPassword');

Route::get('usuario/tienerol/{rol_id}', function (Request $request, $rol_id) {
    $usuario_id = session('usuario_id');
    $usuario = Usuario::find($usuario_id);
    
    return response()->json(['acceso'=>$usuario->tieneRol($rol_id)], 200);
});
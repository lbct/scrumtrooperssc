<?php
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

//Ruta Estado Inscripcion
Route::get('/inscripcion/activa', function (Request $request) {
    $activa = FechasInscripciones::fechaActiva();
    return response()->json(['activa'=>$activa], 200);
});

//Rutas Usuario
Route::get('usuario', 'Usuario\Control@informacion');
Route::put('usuario', 'Usuario\Control@editar');
Route::put('usuario/password', 'Usuario\Control@editarPassword');
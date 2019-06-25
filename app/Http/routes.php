<?php
use \App\Models\Docente;

Route::get('test', function () {
    $clases = Docente::all();
    return $clases[0]->grupoADocente;
});

//Ruta Inicial Login
Route::get('/', 'Sesion\Control@getLogin');

Route::get('login', 'Sesion\Control@getLogin');
Route::post('login', 'Sesion\Control@postLogin');
Route::get('logout', 'Sesion\Control@getLogout');

//Rutas Estudiante
Route::get('estudiante', 'Estudiante\Inicio\Control@getInicio');
Route::get('estudiante/editar', 'Estudiante\Editar\Control@getEditar');
Route::post('estudiante/editar', 'Estudiante\Editar\Control@postEditar');
Route::get('registro', 'Estudiante\Crear\Control@getRegistro');
Route::post('registro', 'Estudiante\Crear\Control@postRegistro');
Route::get('estudiante/inscripcion', 'Estudiante\Inscribir\Control@getInscripcion');
Route::post('estudiante/inscripcion', 'Estudiante\Inscribir\Control@postInscripcion');
Route::get('estudiante/estadoInscripcion', 'Estudiante\Ver\Control@getMaterias');
Route::get('estudiante/portafolio', 'Estudiante\Ver\Control@getPortafolio');
Route::post('estudiante/portafolio', 'Estudiante\Ver\Control@postPortafolio');
Route::post('estudiante/portafolio/ver', 'Estudiante\Ver\Control@postVerPortafolio');
Route::get('estudiante/portafolio/ver', 'Estudiante\Ver\Control@getVerPortafolio');

Route::get('estudiante/horario', 'Estudiante\Ver\Control@verHorario');

Route::get('estudiante/ver/retirar','Estudiante\Retirar\Control@getRetirar');
Route::post('estudiante/ver/retirar',
[
    'as' => 'estudiante/ver/retirar',
    'uses' => 'Estudiante\Retirar\Control@postRetirar'
]);


Route::get('estudiante/subirPractica', 'Estudiante\Subir\Control@verClases');
Route::post('estudiante/subirPractica', 'Estudiante\Subir\Control@getSesion');
Route::get('estudiante/subirPractica/{id_sesion}', [
    'as' => 'estudiante',
    'uses' => 'Estudiante\Subir\Control@getSubir'
]);

Route::get('estudiante/subirPractica/{ID}', [
    'as' => 'estudiante',
    'uses' => 'Estudiante\Subir\Control@eliminarArchivo'
]);
Route::get('estudiante/subirPractica/{ID}', function ($ID) 
{
    $envio = EnvioPractica::find($ID);
    $envio->delete();
    return Redirect::route('/estudiante/subirPractica');
});

Route::post('estudiante/subirPractica/{{$envio->ARCHIVO}}', 'Estudiante\Ver\Control@destroy');

Route::post('estudiante/clases/{id_sesion}', [
    'as' => 'estudiante',
    'uses' => 'Estudiante\Subir\Control@postSubir'
]);
Route::get('estudiante/verPracticas', 'Estudiante\Ver\Control@verPracticas');
Route::post('estudiante/verPracticas', [
    'as' => 'estudiante',
    'uses' => 'Estudiante\Ver\Control@verPracticasMateria'
]);

Route::delete('estudiante/eliminarPractica', 'Estudiante\Eliminar\Control@deletePracticaSubida');

//Rutas Admin
Route::get('administrador', [
    'as' => 'administrador',
    'uses' => 'Admin\Inicio\Control@getInicio'
]);

Route::get('administrador/crearDocente', 'Admin\Docente\Crear\Control@getRegistro');
Route::post('administrador/crearDocente', 'Admin\Docente\Crear\Control@postRegistro');

Route::get('administrador/listaDocente', 'Admin\Docente\Ver\Control@getLista');  //Mostrar lista de docentes registrados

Route::get(
    'administrador/editarDocente/{id_usuario}',
    [
        'as' => 'administrador/editarDocente',
        'uses' => 'Admin\Docente\Editar\Control@getUsuario'
    ]
);

Route::post(
    'administrador/editarDocente/{id_usuario}',
    [
        'as' => 'administrador/editarDocente',
        'uses' => 'Admin\Docente\Editar\Control@postUsuario'
    ]
);
Route::get('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Editar\Control@getClave');
Route::post('administrador/editarDocente/{id_usuario}/cambiarClave', 'Admin\Docente\Editar\Control@postClave');

Route::get('administrador/crearAdmin', 'Admin\Crear\Control@getRegistro');
Route::post('administrador/crearAdmin', 'Admin\Crear\Control@postRegistro');

Route::get('administrador/crearGestion', 'Admin\Gestion\Crear\Control@getRegistro');
Route::post('administrador/crearGestion', 'Admin\Gestion\Crear\Control@postRegistro');

Route::get(
    'administrador/verDocente/{id_usuario}',
    [
        'as' => 'administrador/verDocente',
        'uses' => 'Admin\Docente\Ver\Control@getUsuario'
    ]
);

Route::get('administrador/verGruposDocentes', 'Admin\Crear\Control@getListaGrupoDocentes');
Route::get('administrador/crearGrupoDocentes', 'Admin\Docente\Crear\Control@getGrupoDocentesForm');
Route::post('administrador/crearGrupoDocentes', 'Admin\Docente\Crear\Control@postGrupoDocentesForm');
Route::get(
    'administrador/editarGrupoDocente/{grupo_docente_id}',
    [
        'as' => 'administrador/editarGrupoDocente',
        'uses' => 'Admin\Docente\Editar\Control@getDocentesGrupo'
    ]
);
Route::post(
    'administrador/editarGrupoDocente',
    [
        'as' => 'administrador/editarGrupoDocente',
        'uses' => 'Admin\Docente\Editar\Control@postDocentesGrupo'
    ]
);

Route::get('administrador/crearMateria', 'Admin\Materia\Crear\Control@getRegistro');
Route::post('administrador/crearMateria', 'Admin\Materia\Crear\Control@postRegistro');

//Rutas Auxiliar
Route::get('auxiliar', 'Auxiliar\Inicio\Control@getInicio');
Route::post('auxiliar/iniciarClase',
    [
    'as' => 'auxiliar/iniciarClase',
    'uses' =>'Auxiliar\Clase\Control@postIniciarClase',
    ]
);
Route::get(
    'auxiliar/clases/{id_gestion}',
    [
        'as' => 'auxiliar/clases',
        'uses' => 'Auxiliar\Ver\Control@getClases'
    ]
);
Route::get('auxiliar/clases', 'Auxiliar\Ver\Control@getClasesUltimaGestion');
Route::post(
    'auxiliar/clases',
    [
        'as'   => 'auxiliar/clases',
        'uses' => 'Auxiliar\Ver\Control@postClases'
    ]
);

Route::get('auxiliar/practicas', 'Auxiliar\Ver\Control@getPracticasUltimaGestion');
Route::get(
    'auxiliar/practicas/{id_gestion}',
    [
        'as' => 'auxiliar/practicas',
        'uses' => 'Auxiliar\Ver\Control@getPracticas'
    ]
);
Route::post(
    'auxiliar/practicas',
    [
        'as'   => 'auxiliar/practicas',
        'uses' => 'Auxiliar\Ver\Control@postPracticas'
    ]
);
Route::post(
    'auxiliar/asignar',
    [
        'as' => 'auxiliar/asignar',
        'uses' => 'Auxiliar\Ver\Control@postSesion'
    ]
);
Route::post(
    'auxiliar/clases/estudiante',
    [
        'as' => 'auxiliar/clases/estudiante',
        'uses' => 'Auxiliar\Estudiante\Ver\Control@postEstudiante'
    ]
);

Route::post(
    'auxiliar/clases/estudiante/practica',
    [
        'as' => 'auxiliar/clases/estudiante/practica',
        'uses' => 'Auxiliar\Estudiante\Ver\Control@postPractica'
    ]
);

//Rutas Docente
Route::get('docente', 'Docente\Inicio\Control@getInicio');
Route::get('docente/editar', 'Docente\Editar\Control@getEditar');
Route::post('docente/editar', 'Docente\Editar\Control@postEditar');
Route::get('docente/crearAuxiliar', 'Docente\Auxiliar\Crear\Control@getRegistro');
Route::post('docente/crearAuxiliar', 'Docente\Auxiliar\Crear\Control@postRegistro');
Route::get('docente/subirPractica', 'Docente\Clases\Ver\Control@getClasesUltimaGestion');
Route::post(
    'docente/subirPractica',
    [
        'as' => 'docente/subirPractica',
        'uses' => 'Docente\Clases\Ver\Control@postClases'
    ]
);
Route::post(
    'docente/subirPractica/confirmar',
    [
        'as' => 'docente/subirPractica/confirmar',
        'uses' => 'Docente\Practica\Subir\Control@postConfirmar'
    ]
);
Route::post(
    'docente/subirPractica/subir',
    [
        'as' => 'docente/subirPractica/subir',
        'uses' => 'Docente\Practica\Subir\Control@postSubir'
    ]
);
Route::get('docente/subirPractica/{id_gestion}', 'Docente\Clases\Ver\Control@getClases');

Route::post('docente/clases/crear', 'Docente\Clases\Crear\Control@postCrearClase');
Route::get('docente/clases/crear', 'Docente\Clases\Crear\Control@verMaterias');
Route::post('docente/clases/crear/horario', 'Docente\Clases\Crear\Control@verHorarios');
Route::post('docente/clases/crear/aula', 'Docente\Clases\Crear\Control@verAulas');
Route::get('docente/portafolios', 'Docente\Portafolio\Ver\Control@getPortafolios');
Route::post('docente/portafolios/materias', 'Docente\Portafolio\Ver\Control@verMaterias');
Route::post('docente/portafolios/estudiantes', 'Docente\Portafolio\Ver\Control@verEstudiantes');
Route::post('docente/portafolio', 'Docente\Portafolio\Ver\Control@verPortafolio');

Route::get('docente/informes', 
[
    'as' => 'docente/informes',
    'uses' => 'Docente\Informes\Ver\Control@getClasesUltimaGestion'
]);
Route::get('docente/informes/{id_gestion}', 'Docente\Informes\Ver\Control@getClases');
Route::post('docente/informes/sesion', 
[
    'as' => 'docente/informes/sesion',
    'uses' => 'Docente\Informes\Sesion\Ver\Control@getSesion'
]);
Route::post('docente/informes', 
[
    'as' => 'docente/informes',
    'uses' => 'Docente\Informes\Ver\Control@getListas'
]);

Route::get('docente/listas', 'Docente\Listas\Ver\Control@getClasesUltimaGestion');
Route::post(
    'docente/listas',
    [
        'as' => 'docente/listas',
        'uses' => 'Docente\Listas\Ver\Control@getListas'

    ]
);

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
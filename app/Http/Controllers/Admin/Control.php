<?php
namespace App\Http\Controllers\Admin;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return 'Hola Administrador 
                        <a href="/administrador/crearDocente">Crear Docente</a>
                        <a href="/administrador/listaDocente">Lista Docente</a>
                        <a href="/administrador/crearAdmin">Crear Administrador</a>
                        <a href="/administrador/crearGestion">Crear Gestion</a>
                        <a href="/logout">Salir</a>';
        
        return redirect('login');
    }
    
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'GET Crear cuenta Administrador';
        }
        
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'POST Crear cuenta Administrador';
        }
        
        return redirect('login');
    }
}
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
            return view('admin.index');
        
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
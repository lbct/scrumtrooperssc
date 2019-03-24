<?php
namespace App\Http\Controllers\Admin\Docente;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'GET Crear cuenta Docente';
        }
        
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'POST Crear cuenta Docente';
        }
        
        return redirect('login');
    }
    
    public function getLista(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'Lista Docente';
        }
        
        return redirect('login');
    }
    
    public function getEdit(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'GET Editar cuenta Docente';
        }
        
        return redirect('login');
    }
    
    public function postEdit(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'POST Editar cuenta Docente';
        }
        
        return redirect('login');
    }
}
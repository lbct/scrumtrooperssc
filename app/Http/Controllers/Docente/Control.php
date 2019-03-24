<?php
namespace App\Http\Controllers\Docente;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('docente.index');
        
        return redirect('login');
    }
    
    public function getCrearAuxiliar(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'GET Crear cuenta Auxliar';
        }
        
        return redirect('login');
    }
    
    public function postAuxiliar(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'POST Crear cuenta Auxliar';
        }
        
        return redirect('login');
    }
}
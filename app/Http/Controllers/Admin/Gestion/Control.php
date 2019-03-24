<?php
namespace App\Http\Controllers\Admin\Gestion;

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
            return 'GET Crear Gestion';
        }
        
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return 'POST Crear Gestion';
        }
        
        return redirect('login');
    }
}
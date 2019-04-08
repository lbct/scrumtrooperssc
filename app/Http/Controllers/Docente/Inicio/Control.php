<?php
namespace App\Http\Controllers\Docente\Inicio;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    //Obtiene la vista principal del Docente
    public function getInicio(Request $request)
    {
        if( $this->rol->is($request) )
            return view('docente.index');
        
        return redirect('login');
    }
}
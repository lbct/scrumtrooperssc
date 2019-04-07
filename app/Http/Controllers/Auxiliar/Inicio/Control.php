<?php
namespace App\Http\Controllers\Auxiliar\Inicio;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\Gestion;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\GrupoADocente;
use App\Models\Clase;
use App\Models\EstudianteClase;
use App\Models\Estudiante;
use App\Models\SesionEstudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auxiliar\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getInicio(Request $request)
    {
        if( $this->rol->is($request) )
            return view('auxiliar.index');
        return redirect('login');
    }
}
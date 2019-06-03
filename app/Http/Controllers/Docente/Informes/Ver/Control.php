<?php
namespace App\Http\Controllers\Docente\Informes\Ver;

use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\Materia;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\GuiaPractica;
use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\Gestion;
use App\Classes\Rol;
use App\Models\Clase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Response;

class Control extends Base
{
    //Obtiene la vista principal del Docente
    public function getInformes(Request $request)
    {
        if( $this->rol->is($request)){
            return view('docente.informes.ver');
        }
        return redirect('login');
    }
}
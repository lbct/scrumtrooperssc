<?php
namespace App\Http\Controllers\Auxiliar\Estudiante\Ver;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\Gestion;
use App\Models\GuiaPractica;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\GrupoADocente;
use App\Models\Clase;
use App\Models\EstudianteClase;
use App\Models\EnvioPractica;
use App\Models\Estudiante;
use App\Models\SesionEstudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auxiliar\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{    
    public function postEstudiante(Request $request)
    {
        $sesion_est = SesionEstudiante::where('SESION_ID', $request->sesion_id)
        ->where('ESTUDIANTE_ID', $request->estudiante_id)
        ->get()->first();
        $estudiante = Estudiante::find($request->estudiante_id);
        $practica = EnvioPractica::where('SESION_ESTUDIANTE_ID', $sesion_est->ID)->first();
        return view('auxiliar.estudiante.ver.estado')
        ->with('sesion_estudiante', $sesion_est)
        ->with('estudiante', $estudiante)
        ->with('practica', $practica);
    }

    public function postPractica(Request $request)
    {
        $sesion_est = SesionEstudiante::find($request->sesion_estudiante_id);
        $sesion_est->COMENTARIO_AUXILIAR = $request->comentario;
        $sesion_est->update();
        $request->session()->flash('alert-success', 'Comentario publicado');
        return redirect('/auxiliar/clases');
    }
}
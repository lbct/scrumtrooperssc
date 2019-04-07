<?php

namespace App\Http\Controllers\Estudiante;

use App\Models\Usuario;
use App\Models\EstudianteClase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoInscripcion extends Base
{
    public function getLista(Request $request)
    {
        if( $this->rol->is($request) )
        
        {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $materias = EstudianteClase::where("ESTUDIANTE_ID",$estudiante->ID)
                    ->join("CLASE","ESTUDIANTE_CLASE.CLASE_ID","=","CLASE.ID")
                    ->join("GRUPO_A_DOCENTE","GRUPO_A_DOCENTE.ID","=","CLASE.GRUPO_A_DOCENTE_ID")
                    ->join("GRUPO_DOCENTE","GRUPO_DOCENTE.ID","=","GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                    ->join("MATERIA","MATERIA.ID","=","GRUPO_DOCENTE.MATERIA_ID")
                    ->select("NOMBRE_MATERIA")
                    ->get();
           
            return view('estudiante.estadoInscripcion')->with('materias', $materias);
        }
        
        return redirect('login');
    }
}

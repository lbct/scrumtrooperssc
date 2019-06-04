<?php
namespace App\Http\Controllers\Estudiante\Retirar;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Docente;
use App\Models\Gestion;
use App\Models\GrupoDocente;
use App\Models\EstudianteClase;
use App\Models\Clase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    //Obtiene la vista para retirar al Estudiante (con sesión iniciada) de una materia
    public function getRetirar(Request $request)
    {
        if ($this->rol->is($request)) {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                ->select("NOMBRE_MATERIA","CODIGO_MATERIA")
                ->get();

            return view('estudiante.ver.retirar')->with('materias', $materias);
        }

        return redirect('login');  
        
    
    }
    //Elimimina al estudiante inscrito en alguna materia
    public function postRetirar(Request $request)
    {
        if($this->rol->is($request))
        {
            $eliminar = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->delete("CLASE_ID")
                ->save();

                return view('estudiante.ver.retirar')->with('materias', $materias);

                $request->EstudianteClase()->flash('alert-success', 'Ha retirado sus materias Satisfactoriamente');
        }
            
        return redirect('login');
    }
}
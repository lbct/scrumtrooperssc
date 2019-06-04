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
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                ->where('MATERIA.GESTION_ID', '=', $id_gestion)
                ->select("MATERIA.ID","NOMBRE_MATERIA","CODIGO_MATERIA")
                ->get();

            return view('estudiante.ver.retirar')
            ->with('materias', $materias)
            ->with('estudiante_id', $estudiante->ID);
        }

        return redirect('login');  
        
    
    }
    //Elimimina al estudiante inscrito en alguna materia
    public function postRetirar(Request $request)
    {
        if($this->rol->is($request))
        {
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            $materias = EstudianteClase::where("ESTUDIANTE_ID", $request->estudiante_id)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                ->where('MATERIA.GESTION_ID', '=', $id_gestion)
                ->select("MATERIA.ID","NOMBRE_MATERIA","CODIGO_MATERIA")
                ->get();
            $datos = array_keys($request->all());
            foreach($datos as $dato){
                $materia = Materia::find($dato);
                if($materia != null){
                    $id_est_clase = Clase::join('GRUPO_A_DOCENTE', 'CLASE.GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
                    ->join('GRUPO_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID')
                    ->join('ESTUDIANTE_CLASE', 'ESTUDIANTE_CLASE.CLASE_ID', '=', 'CLASE.ID')
                    ->where('ESTUDIANTE_CLASE.ESTUDIANTE_ID', '=', $request->estudiante_id)
                    ->where('GRUPO_DOCENTE.MATERIA_ID', '=', $materia->ID)
                    ->select('ESTUDIANTE_CLASE.ID')
                    ->get()
                    ->first();

                    $eliminar = EstudianteClase::find($id_est_clase->ID);
                    $eliminar->delete();
                }
            }
            $request->session()->flash('alert-success', 'Ha retirado sus materias Satisfactoriamente');
            return redirect('estudiante/ver/retirar')
            ->with('materias', $materias)
            ->with('estudiante_id', $request->estudiante_id);
        }
        return redirect('login');
    }
}
<?php
namespace App\Http\Controllers\Estudiante\Inscribir;

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
    //Obtiene la vista para inscribir al Estudiante (con sesión iniciada) a una materia
    public function getInscripcion(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $gestion = Gestion::select('ID')
                       ->orderBy('ANO_GESTION','desc')
                       ->first();
            
            $materias = Materia::where('GESTION_ID',$gestion->ID)
                        ->select('MATERIA.ID', 'NOMBRE_MATERIA')
                        ->get();
            
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;
            $materiasRegistradas = EstudianteClase::where("ESTUDIANTE_ID",$estudiante->ID)
                    ->join("CLASE","ESTUDIANTE_CLASE.CLASE_ID","=","CLASE.ID")
                    ->join("GRUPO_A_DOCENTE","GRUPO_A_DOCENTE.ID","=","CLASE.GRUPO_A_DOCENTE_ID")
                    ->join("GRUPO_DOCENTE","GRUPO_DOCENTE.ID","=","GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                    ->join("MATERIA","MATERIA.ID","=","GRUPO_DOCENTE.MATERIA_ID")
                    ->where('MATERIA.GESTION_ID',$gestion->ID)
                    ->select("MATERIA.ID","NOMBRE_MATERIA")
                    ->get();
            
            $materiasDisponibles = $materias->diff($materiasRegistradas);
            
            return view('estudiante.inscribir')->with('materias', $materiasDisponibles);
        }
            
        return redirect('login');
    }

    //Registra la inscripción de las materias del Estudiante con sesión iniciada
    public function postInscripcion(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $paso = $request->paso;
            if($paso == 2)
            {
                $materia = $request->materia;
                $gruposdocentes =   Materia::where('MATERIA.ID', $materia)
                                    ->join('GRUPO_DOCENTE', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
                                    ->join('GRUPO_A_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID')
                                    ->join('DOCENTE', 'GRUPO_A_DOCENTE.DOCENTE_ID', '=', 'DOCENTE.ID')
                                    ->join('USUARIO', 'DOCENTE.USUARIO_ID', '=', 'USUARIO.ID')
                                    ->select('GRUPO_DOCENTE.ID', 'NOMBRE', 'APELLIDO')
                                    ->get();

                return $gruposdocentes;
            }
            else if($paso == 3 && $request->horario==null)
            {
                $grupoDocente = $request->docente;
                $clases =   GrupoDocente::where('GRUPO_DOCENTE.ID', $grupoDocente)
                            ->join('GRUPO_A_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID')
                            ->join('CLASE', 'GRUPO_A_DOCENTE.ID', '=', 'CLASE.GRUPO_A_DOCENTE_ID')
                            ->join('HORARIO', 'CLASE.HORARIO_ID', '=', 'HORARIO.ID')
                            ->join('AULA', 'CLASE.AULA_ID', '=', 'AULA.ID')
                            ->select('CLASE.ID', 'NOMBRE_AULA', 'HORA_INICIO', 'HORA_FIN', 'DIA')
                            ->get();
                
                return $clases;
            }
            else if($request->horario!=null)
            {
                $gestion = Gestion::select('ID')
                           ->orderBy('ANO_GESTION','desc')
                           ->first();
                
                $clase = intval($request->horario);
                $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;
                
                $valido = true;
                $materiaDeClase = Clase::find($clase)->grupoADocente->grupoDocente->materia->ID;
                $claseEnGestion = Clase::find($clase);
                $materiasRegistradas = EstudianteClase::where("ESTUDIANTE_ID",$estudiante->ID)
                    ->join("CLASE","ESTUDIANTE_CLASE.CLASE_ID","=","CLASE.ID")
                    ->join("GRUPO_A_DOCENTE","GRUPO_A_DOCENTE.ID","=","CLASE.GRUPO_A_DOCENTE_ID")
                    ->join("GRUPO_DOCENTE","GRUPO_DOCENTE.ID","=","GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                    ->join("MATERIA","MATERIA.ID","=","GRUPO_DOCENTE.MATERIA_ID")
                    ->select("MATERIA.ID","NOMBRE_MATERIA")
                    ->where('MATERIA.GESTION_ID',$gestion->ID)
                    ->get();

                if($claseEnGestion->GESTION_ID != $gestion->ID)
                    $valido = false;
                else if( $materiasRegistradas->find($materiaDeClase) !=null )
                    $valido = false;
                
                if($valido)
                {
                    $estudianteClase = new EstudianteClase();

                    $estudianteClase->CLASE_ID      = $clase;
                    $estudianteClase->ESTUDIANTE_ID = $estudiante->ID;

                    $estudianteClase->save();
                    $request->session()->flash('alert-success', '¡Inscrito a la materia con éxito!');
                    return redirect('/estudiante/estadoInscripcion');
                }
            }
            
            $request->session()->flash('alert-danger', 'No se pudo inscribir a la materia');
            return redirect('/estudiante/inscripcion')->withInput();
        }
        
        return redirect('login');
    }
}
<?php
namespace App\Http\Controllers\Docente\Listas\Ver;

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
use App\Models\Estudiante;
use App\Models\EstudianteClase;
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
    public function getClasesUltimaGestion(Request $request)
    {
        if( $this->rol->is($request)){
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            return $this->getClases($request, $id_gestion);
        }
        return redirect('login');
    }

    public function getClases(Request $request, $id_gestion){
        if( $this->rol->is($request) ){
            $usuarioId = $request->cookie('USUARIO_ID');
            $docenteId = Docente::where('USUARIO_ID', '=', $usuarioId)->get()->first()->ID;
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();
            

            $gruposDocente = GrupoDocente::join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('MATERIA', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
            ->where('GRUPO_A_DOCENTE.DOCENTE_ID', '=', $docenteId)
            ->where('MATERIA.GESTION_ID', '=', $id_gestion)
            ->select('GRUPO_A_DOCENTE.ID', 'GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE', 'MATERIA.NOMBRE_MATERIA', 'MATERIA.CODIGO_MATERIA')
            ->get();

            return view('docente.ver.estudiantes.materias')
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones)
                ->with('materias', $gruposDocente);
        }
        return redirect('login');
    }

    public function getListas(Request $request){
        $gestionID = $request->gestion_id;
        $grupoDocenteID = $request->grupo_a_docente_id;
        $clases = Clase::where('GRUPO_A_DOCENTE_ID', '=', $grupoDocenteID)->get();
        $nombres = [];
        foreach ($clases as $clase) {
            $estudiantes = EstudianteClase::where('CLASE_ID', '=', $clase->ID)->get();
            foreach ($estudiantes as $estudiante){
                $nombre = Estudiante::where('ESTUDIANTE.ID', '=', $estudiante->ESTUDIANTE_ID)
                            ->join('USUARIO', 'USUARIO.ID', '=', 'ESTUDIANTE.USUARIO_ID')
                            ->select('NOMBRE', 'APELLIDO', 'CODIGO_SIS')
                            ->first();
                array_push($nombres, $nombre);
            }
        }
        
        usort($nombres, function($a, $b) {
            $a = mb_strtolower($a);
            $b = mb_strtolower($b);
            return strcmp($a, $b);
        });
        
        return view('docente.ver.estudiantes.listas')
        ->with('nombres', $nombres);
    }
}
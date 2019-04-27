<?php
namespace App\Http\Controllers\Docente\Clases\Crear;

use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\Materia;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\GuiaPractica;
use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\Gestion;
use App\Models\Horario;
use App\Models\Aula;
use App\Classes\Rol;
use App\Models\Clase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Input;
use Response;

class Control extends Base
{
    private function getClasesUltimaGestion()
    {
        $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
        return $id_gestion;
    }
    
    public function verMaterias(Request $request){
        if( $this->rol->is($request) ){
            $id_usuario = $request->cookie('USUARIO_ID');
            $id_gestion = $this->getClasesUltimaGestion();
            $id_docente = Docente::where('USUARIO_ID', '=', $id_usuario)->get()->first()->ID;
            
            $gruposDocente = GrupoDocente::join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('MATERIA', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
            ->where('GRUPO_A_DOCENTE.DOCENTE_ID', '=', $id_docente)
            ->where('MATERIA.GESTION_ID', '=', $id_gestion)
            ->select('GRUPO_DOCENTE.ID', 'GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE', 'MATERIA.NOMBRE_MATERIA', 'MATERIA.CODIGO_MATERIA')
            ->get();
            
            return view('docente.clases.crear')
                ->with('id_gestion', $id_gestion)
                ->with('materias', $gruposDocente);
        }
        
        return redirect('login');
    }

    public function verHorarios(Request $request){
        if( $this->rol->is($request) ){
            $grupo_docente = $request->grupo_docente_id;
            $id_usuario = $request->cookie('USUARIO_ID');
            $id_gestion = $this->getClasesUltimaGestion();
            $id_docente = Docente::where('USUARIO_ID', '=', $id_usuario)->get()->first()->ID;
            
            $clases_actuales     = Clase::where("CLASE.GESTION_ID", $id_gestion)
                                 ->join("GESTION", "GESTION.ID", "=", "CLASE.GESTION_ID")
                                 ->join("HORARIO", "HORARIO.ID", "=", "CLASE.HORARIO_ID")
                                 ->join("AULA", "AULA.ID", "=", "CLASE.AULA_ID")
                                 ->select("AULA_ID", "NOMBRE_AULA", "HORARIO_ID", "HORA_INICIO", "HORA_FIN", "DIA")
                                 ->get();
            
            $horarios = Horario::orderBy("HORA_INICIO")
                        ->get();
            
            $cant_aulas    = Aula::all()->count();
            
            $horarios_disponibles = collect();
            
            foreach($horarios as $horario) {
                $init_horarios        = collect(['1' => $cant_aulas, '2' => $cant_aulas,
                                                 '3' => $cant_aulas, '4' => $cant_aulas,
                                                 '5' => $cant_aulas, '6' => $cant_aulas]);
                
                $horarios_disponibles->put($horario->ID, $init_horarios);
            }
            
            foreach($clases_actuales as $clase) {
                $valor_actual = $horarios_disponibles[$clase->HORARIO_ID][$clase->DIA];
                $horarios_disponibles[$clase->HORARIO_ID][$clase->DIA] = $valor_actual-1;
            }
            
            return view('docente.clases.crear01')
                ->with('horarios', $horarios)
                ->with('horarios_disponibles', $horarios_disponibles)
                ->with('grupo_docente', $grupo_docente);
        }
        
        return redirect('login');
    }
    
    public function verAulas(Request $request){
        if( $this->rol->is($request) ){
            $id_usuario = $request->cookie('USUARIO_ID');
            $id_gestion = $this->getClasesUltimaGestion();
            $id_docente = Docente::where('USUARIO_ID', '=', $id_usuario)->get()->first()->ID;
            $id_grupo_docente = $request->grupo_docente_id;
            $id_horario = $request->horario_id;
            $dia = $request->dia;
            
            $aulas_totales = Aula::select("AULA.ID as AULA_ID", "AULA.NOMBRE_AULA")
                             ->get();
            
            $aulas_ocupadas = Clase::where("CLASE.GESTION_ID", $id_gestion)
                              ->join("AULA", "AULA.ID", "=", "CLASE.AULA_ID")
                              ->where("CLASE.DIA", $dia)
                              ->where("CLASE.HORARIO_ID", $id_horario)
                              ->select("CLASE.AULA_ID")
                              ->get();
            
            $aulas_disponibles = collect();
            
            foreach ($aulas_totales as $aula) {
                $disponible = true;
                foreach ($aulas_ocupadas as $aula_ocupada) {
                    if($aula->AULA_ID == $aula_ocupada->AULA_ID)
                        $disponible = false;
                }
                
                if($disponible)
                    $aulas_disponibles->push($aula);
            }
            
            $horario = Horario::find($id_horario);
            $grupo_docente = GrupoDocente::find($id_grupo_docente);
            $materia = $grupo_docente->materia->NOMBRE_MATERIA;
            
            if($dia == 1)
                $dia_literal = "Lunes";
            else if($dia == 2)
                $dia_literal = "Martes";
            else if($dia == 3)
                $dia_literal = "Miercoles";
            else if($dia == 4)
                $dia_literal = "Jueves";
            else if($dia == 5)
                $dia_literal = "Viernes";
            else if($dia == 6)
                $dia_literal = "Sábado";
            
            return view('docente.clases.crear02')
                //->with('horarios', $horarios)
                ->with('aulas_disponibles', $aulas_disponibles)
                ->with('horario', $horario)
                ->with('dia', $dia)
                ->with('dia_literal', $dia_literal)
                ->with('grupo_docente', $id_grupo_docente)
                ->with('materia', $materia);
        }
        
        return redirect('login');
    }
    
    public function postCrearClase(Request $request){
        if( $this->rol->is($request) ){
            $id_usuario = $request->cookie('USUARIO_ID');
            $id_gestion = $this->getClasesUltimaGestion();
            $id_docente = Docente::where('USUARIO_ID', '=', $id_usuario)->get()->first()->ID;
            $id_grupo_docente = $request->grupo_docente_id;
            $id_horario = $request->horario_id;
            $id_aula = $request->aula_id;
            $dia = $request->dia;

            $clase_similar = GrupoDocente::where("GRUPO_DOCENTE.ID", $id_grupo_docente)
                             ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID", "=", "GRUPO_DOCENTE.ID")
                             ->join("CLASE", "CLASE.GRUPO_A_DOCENTE_ID", "=", "GRUPO_A_DOCENTE.ID")
                             ->first();
            
            $grupo_a_docente = GrupoADocente::where("GRUPO_DOCENTE_ID", $id_grupo_docente)
                               ->where("DOCENTE_ID", $id_docente)
                               ->first();
            
            $clase = new Clase();
            $clase->GESTION_ID         = $id_gestion;
            $clase->AULA_ID            = $id_aula;
            $clase->HORARIO_ID         = $id_horario;
            $clase->GRUPO_A_DOCENTE_ID = $grupo_a_docente->ID;
            $clase->DIA                = $dia;
            
            if( $clase_similar==null )
            {
                $clase->SEMANA_ACTUAL_SESION = 0;
                $clase->save();
            }   
            else
            {
                $sesiones_similares = Sesion::where("CLASE_ID", $clase_similar->ID)
                                      ->get();
                $clase->SEMANA_ACTUAL_SESION = $clase_similar->SEMANA_ACTUAL_SESION;
                $clase->save();
                
                foreach ($sesiones_similares as $sesion_similar) {
                    $sesion = new Sesion();
                    $sesion->CLASE_ID         = $clase->ID;
                    $sesion->GUIA_PRACTICA_ID = $sesion_similar->GUIA_PRACTICA_ID;
                    $sesion->SEMANA           = $sesion_similar->SEMANA;
                    $sesion->save();
                }
            }
            
            $request->session()->flash('alert-success', '¡Clase creada con éxito!');
            
            return redirect('/docente/clases/crear');
        }

        return redirect('login');
    }
}
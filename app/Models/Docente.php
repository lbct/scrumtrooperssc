<?php

namespace App\Models;

use App\Models\Clase;
use App\Models\GrupoADocente;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'docente';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
    
    public function grupoADocente()
    {
        return $this->hasMany('App\Models\GrupoADocente', 'docente_id', 'id');
    }
    
    public function materias($gestion_id)
    {
        $materias = GrupoADocente::where('docente_id', $this->id)
                    ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_a_docente.grupo_docente_id')
                    ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                    ->where('materia.gestion_id', $gestion_id)
                    ->select("grupo_docente_id as id", "nombre_materia")
                    ->get();
        
        return $materias;
    }
    
    public function clases($gestion_id){
        $clases = GrupoADocente::where('docente_id', $this->id)
                  ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_a_docente.grupo_docente_id')
                  ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                  ->where('clase.gestion_id', $gestion_id)
                  ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                  ->join('aula', 'aula.id', '=', 'clase.aula_id')
                  ->join('horario', 'horario.id', '=', 'clase.horario_id')
                  ->select('dia', 'horario_id', 'nombre_aula', 'nombre_materia', 'detalle_grupo_docente', 'semana_actual_sesion', 'hora_inicio', 'hora_fin')
                  ->get();
            
        return $clases;
    }
    
    public function gestiones()
    {
        $todas_las_gestiones = GrupoADocente::where('docente_id', $this->id)
                               ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_a_docente.grupo_docente_id')
                               ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                               ->join('gestion', 'gestion.id', '=', 'materia.gestion_id')
                               ->join('periodo', 'periodo.id', '=', 'gestion.periodo_id')
                               ->select('gestion.id as id', 'gestion.anho_gestion as anho_gestion', 'periodo.descripcion as periodo', 'gestion.activa as activa')
                               ->get();
        
        $gestiones = $todas_las_gestiones->unique(function ($item) {
                            return $item['id'];
                      });
        
        return $gestiones;
    }
    
    public function auxiliaresAginados($gestion_id)
    {
        $auxiliares = GrupoADocente::where('docente_id', $this->id)
                      ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_a_docente.grupo_docente_id')
                      ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                      ->where('materia.gestion_id', $gestion_id)
                      ->join('grupo_docente_auxiliar', 'grupo_docente_auxiliar.grupo_docente_id', '=', 'grupo_docente.id')
                      ->join('auxiliar', 'auxiliar.id', '=', 'grupo_docente_auxiliar.auxiliar_id')
                      ->join('usuario', 'usuario.id', '=', 'auxiliar.usuario_id')
                      ->select('grupo_docente_auxiliar.id as grupo_docente_auxiliar_id', 'grupo_docente_auxiliar.grupo_docente_id', 'grupo_docente_auxiliar.auxiliar_id as id', 'materia.nombre_materia', 'nombre', 'apellido', 'correo')
                      ->get();
        
        $auxiliares = $auxiliares->map(function ($auxiliar) {
                        $grupo_docente_id = $auxiliar['grupo_docente_id'];
                        $auxiliar_id = $auxiliar['id'];
                        $auxiliar['clases_cursadas'] = $this->clasesCursadas($grupo_docente_id, $auxiliar_id);
                        return $auxiliar;
                      });
        
        return $auxiliares;
    }
    
    private function clasesCursadas($grupo_docente_id, $auxiliar_id)
    {
        $clases_cursadas = Clase::where('grupo_docente_id', $grupo_docente_id)
                           ->join('sesion', 'sesion.clase_id', '=', 'clase.id')
                           ->where('sesion.auxiliar_terminal_id', $auxiliar_id)
                           ->get()
                           ->count();
        
        return $clases_cursadas;
    }
}

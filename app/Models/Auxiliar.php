<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\Clase;
use App\Models\Sesion;
use App\Models\SesionEstudiante;
use App\Models\GuiaPractica;

class Auxiliar extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'auxiliar';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'auxiliar_id', 'id');
    }
    
    public function esAuxiliarTerminal($grupo_docente_id){
        $es_auxiliar_terminal = false;
        
        $registrado = GrupoDocenteAuxiliar::where("auxiliar_id", $this->id)
                      ->where('grupo_docente_id', $grupo_docente_id)
                      ->first();
        
        if($registrado)
            $es_auxiliar_terminal = true;
        
        return $es_auxiliar_terminal;
    }
    
    public function materias($gestion_id){
        $materias = GrupoDocenteAuxiliar::where('auxiliar_id', $this->id)
                    ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_auxiliar.grupo_docente_id')
                    ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                    ->where('materia.gestion_id', $gestion_id)
                    ->select('grupo_docente_id as id', 'nombre_materia', 'detalle_grupo_docente')
                    ->get();
        
        $materias = $materias->map(function ($materia) {
                        $grupo_docente_id = $materia['id'];
                        $grupo_docente = GrupoDocente::find($grupo_docente_id);
                        $materia['maxima_semana'] = $grupo_docente->maximaSemanaActual();
                        return $materia;
                     });
        
        return $materias;
    }
    
    public function accesoClase($clase_id){
        $acceso_clase = false;
        
        $clase = Clase::find($clase_id);
        if($clase){
            $grupo_docente_id = Clase::find($clase_id)->grupo_docente_id;
            $acceso_clase = $this->esAuxiliarTerminal($grupo_docente_id);
        }
        
        return $acceso_clase;
    }
    
    public function accesoSesion($sesion_id){
        $acceso_sesion = false;
        $sesion = Sesion::find($sesion_id);
        
        if($sesion && $sesion->semana <= $sesion->clase->semana_actual_sesion+1)
            $acceso_sesion = $this->accesoClase($sesion->clase_id);
        
        return $acceso_sesion;
    }
    
    public function accesoSesionEstudiante($sesion_estudiante_id){
        $acceso_sesion_estudiante = false;
        $sesion_estudiante = SesionEstudiante::find($sesion_estudiante_id);
        
        if($sesion_estudiante)
            $acceso_sesion_estudiante = $this->accesoSesion($sesion_estudiante->sesion_id);
        
        return $acceso_sesion_estudiante;
    }
    
    public function accesoGuiaPractica($guia_practica_id){
        $acceso = false;
        $sesion = Sesion::where('guia_practica_id', $guia_practica_id)
                  ->first();
        
        if($sesion && $this->accesoSesion($sesion->id))
            $acceso = true;
        
        return $acceso;
    }
}

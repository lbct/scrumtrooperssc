<?php

namespace App\Models;

use App\Models\GrupoDocente;
use App\Models\EstudianteClase;
use App\Models\Clase;
use Illuminate\Database\Eloquent\Model;

class GrupoADocente extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'grupo_a_docente';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'grupo_docente_id');
    }
    
    public function docente()
    {
        return $this->belongsTo('App\Models\Docente', 'docente_id');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'grupo_a_docente_id', 'id');
    }
    
    public function esBorrable()
    {
        $borrable = true;
        
        $clase_cursada = EstudianteClase::where('grupo_a_docente_id', $this->id)
                         ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                         ->where('sesion_estudiante.asistencia_sesion', true)
                         ->first();
        
        if($clase_cursada)
            $borrable = false;
        
        return $borrable;
    }
    
    public function clases()
    {
        $clases = GrupoDocente::where('grupo_docente.id', $this->grupo_docente_id)
                  ->join("clase", "clase.grupo_docente_id", "=", "grupo_docente.id")
                  ->join("aula", "aula.id", "=", "clase.aula_id")
                  ->join("horario", "horario.id", "=", "clase.horario_id")
                  ->select("clase.id as id", "materia_id", "grupo_docente_id", "detalle_grupo_docente", "nombre_aula", "dia", "hora_inicio", "hora_fin")
                  ->get();
        
        return $clases;
    }
    
    public function clasesLibres()
    {
        $clases = GrupoDocente::where('grupo_docente.id', $this->grupo_docente_id)
                  ->join("clase", "clase.grupo_docente_id", "=", "grupo_docente.id")
                  ->join("aula", "aula.id", "=", "clase.aula_id")
                  ->join("horario", "horario.id", "=", "clase.horario_id")
                  ->select("clase.id as id", "materia_id", "grupo_docente_id", "detalle_grupo_docente", "nombre_aula", "dia", "hora_inicio", "hora_fin")
                  ->get();
        
        foreach($clases as $clase){
            $clase_aux = Clase::find($clase->id);
            $clase['disponible'] = $clase_aux->cupoDisponible();
        }
        
        return $clases;
    }
    
    public function clasesLibresEstudiante($estudiante_id)
    {
        $clases = GrupoDocente::where('grupo_docente.id', $this->grupo_docente_id)
                  ->join("clase", "clase.grupo_docente_id", "=", "grupo_docente.id")
                  ->join("aula", "aula.id", "=", "clase.aula_id")
                  ->join("horario", "horario.id", "=", "clase.horario_id")
                  ->select("clase.id as id", "materia_id", "grupo_docente_id", "detalle_grupo_docente", "nombre_aula", "dia", "hora_inicio", "hora_fin")
                  ->get();
        
        foreach($clases as $clase){
            $clase_aux = Clase::find($clase->id);
            $clase['disponible'] = $clase_aux->cupoDisponibleEstudiante($estudiante_id);
        }
        
        return $clases;
    }
    
    public function estudiantes()
    {
        $estudiantes = EstudianteClase::where('grupo_a_docente_id', $this->id)
                       ->join('estudiante', 'estudiante.id', '=', 'estudiante_clase.estudiante_id')
                       ->join('usuario', 'usuario.id', '=', 'estudiante.usuario_id')
                       ->select('estudiante_clase.id as id','codigo_sis', 'nombre', 'apellido', 'correo')
                       ->orderBy('apellido')
                       ->get();
        
        $estudiantes = $estudiantes->map(function ($estudiante) {
                        $estudiante['semanas_asistidas'] = $estudiante->semanasAsistidas()->count();
                        $estudiante['semanas_totales'] = $estudiante->semanasTotales()->count();
                        $estudiante['en_laboratorio'] = $estudiante->enviosEnLaboratorio();
                        $estudiante['envios_totales'] = $estudiante->enviosTotales();
                        return $estudiante;
                       });
        
        return $estudiantes;
    }
    
    public function accesoClase($clase_id){
        $acceso = false;
        $clase = Clase::find($clase_id);
        
        if($clase && $clase->grupo_docente_id == $this->grupo_docente_id)
            $acceso = true;
        
        return $acceso;
    }
}

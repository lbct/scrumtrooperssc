<?php

namespace App\Models;

use App\Models\SesionEstudiante;
use App\Models\Estudiante;
use App\Models\Clase;
use Illuminate\Database\Eloquent\Model;

class EstudianteClase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'estudiante_clase';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'clase_id');
    }
    
    public function grupoADocente()
    {
        return $this->belongsTo('App\Models\GrupoADocente', 'grupo_a_docente_id');
    }
    
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'estudiante_id');
    }
    
    public function semanasAsistidas()
    {
        $semanas = SesionEstudiante::where('estudiante_clase_id', $this->id)
                   ->where('asistencia_sesion', true)
                   ->get();
        
        return $semanas;
    }
    
    public function semanasTotales()
    {
        $semanas = SesionEstudiante::where('estudiante_clase_id', $this->id)
                   ->get();
        
        return $semanas;
    }
    
    public function datosEstudiante()
    {
        $estudiante = Estudiante::where('estudiante.id', $this->estudiante_id)
                      ->join('usuario', 'usuario.id', '=', 'estudiante.usuario_id')
                      ->select('nombre', 'apellido', 'correo', 'codigo_sis')
                      ->first();
        
        return $estudiante;
    }
    
    public function datosClase()
    {
        $clase = Clase::where('clase.id', $this->clase_id)
                 ->join('grupo_docente', 'grupo_docente.id', '=', 'clase.grupo_docente_id')
                 ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                 ->join('horario', 'horario.id', '=', 'clase.horario_id')
                 ->join('aula', 'aula.id', '=', 'clase.aula_id')
                 ->select('clase.id as id','nombre_materia', 'nombre_aula', 'hora_inicio', 'hora_fin', 'detalle_grupo_docente', 'dia', 'semana_actual_sesion')
                 ->first();
        
        return $clase;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clase;

class Clase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'clase';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'grupo_docente_id');
    }
    
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion', 'gestion_id');
    }
    
    public function aula()
    {
        return $this->belongsTo('App\Models\Aula', 'aula_id');
    }
    
    public function horario()
    {
        return $this->belongsTo('App\Models\Horario', 'horario_id');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'clase_id', 'id');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'clase_id', 'id');
    }
    
    public function sesionActual()
    {
        $sesion = Sesion::where('clase_id', $this->id)
                  ->where('sesion.semana', '=', $this->semana_actual_sesion)
                  ->first();
        
        return $sesion;
    }
    
    public function siguienteSesion()
    {
        $siguiente_sesion = Sesion::where('clase_id', $this->id)
                            ->where('sesion.semana', '=', $this->semana_actual_sesion+1)
                            ->select('sesion.id', 'guia_practica_id')
                            ->first();
            
        return $siguiente_sesion;
    }
    
    public function sesionEnCurso()
    {
        $sesion_en_curso = false;
        $sesion = $this->sesionActual();
        
        if($sesion && $sesion->enCurso())
            $sesion_en_curso = true;
        
        return $sesion_en_curso;
    }   
}

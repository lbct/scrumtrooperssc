<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clase;
use App\Models\Sesion;

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
    
    public function sesiones()
    {
        $sesiones = Sesion::where('clase_id', $this->id)
                    ->join('guia_practica', 'guia_practica.id', '=', 'sesion.guia_practica_id')
                    ->orderBy('semana', 'desc')
                    ->select('sesion.id as id', 'semana', 'guia_practica_id', 'archivo')
                    ->get();
        
        if($sesiones){        
            $sesiones = $sesiones->map(function ($sesion) {
                        if($sesion->semana > $this->semana_actual_sesion)
                            $sesion['borrable'] = true;
                        else
                            $sesion['borrable'] = false;
                            
                        return $sesion;
                      });
        }
        
        return $sesiones;
    }
    
    public function sesionesDisponibles()
    {        
        $sesiones = Sesion::where('clase_id', $this->id)
                    ->where('sesion.semana', '<=', $this->semana_actual_sesion)
                    ->orderBy('sesion.semana', 'desc')
                    ->get();
        
        return $sesiones;
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
        $siguiente = false;
        
        $siguiente_sesion = Sesion::where('clase_id', $this->id)
                            ->where('sesion.semana', '=', $this->semana_actual_sesion+1)
                            ->first();
            
        if($siguiente_sesion)
            $siguiente = true;
        
        return $siguiente;
    }
    
    public function sesionEnCurso()
    {
        $sesion_en_curso = false;
        $sesion = $this->sesionActual();
        
        if($sesion && $sesion->enCurso())
            $sesion_en_curso = true;
        
        return $sesion_en_curso;
    }
    
    public function maximaSemana()
    {
        $semana = Sesion::where('clase_id', $this->id)
                  ->max('semana');
        
        return $semana;
    }
    
    public function agregarSesion($guia_practica_id, $semana)
    {
        $sesion = new Sesion;
        $sesion->clase_id         = $this->id;
        $sesion->guia_practica_id = $guia_practica_id;
        $sesion->semana           = $semana;
        $sesion->save();
    }
}

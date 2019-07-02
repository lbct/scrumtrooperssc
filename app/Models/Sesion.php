<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InicioClase;
use App\Models\SesionEstudiante;
use App\Models\EstudianteClase;
use Carbon\Carbon;

class Sesion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sesion';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'clase_id');
    }
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'auxiliar_id');
    }
    
    public function guiaPractica()
    {
        return $this->belongsTo('App\Models\GuiaPractica', 'guia_practica_id');
    }
    
    public function sesionEstudiante()
    {
        return $this->hasMany('App\Models\SesionEstudiante', 'sesion_id', 'id');
    }
    
    public function enCurso()
    {
        $en_curso = false;
        $inicio_clase = InicioClase::where('sesion_id', $this->id)
                        ->first();
        
        if($inicio_clase && $inicio_clase->enCurso())
            $en_curso = true;
        
        return $en_curso;
    }
    
    public function iniciar($auxiliar_id)
    {
        $this->auxiliar_terminal_id = $auxiliar_id;
        $this->save();
        
        $fecha_actual  = Carbon::now();
        $inicio_sesion = $fecha_actual->toDateTimeString();
        $fin_sesion    = $fecha_actual->addMinutes(105)->toDateTimeString();
        
        $estudiantes_clase = EstudianteClase::where('clase_id', $this->clase_id)
                             ->select('estudiante_clase.id')
                             ->get();
        
        foreach ($estudiantes_clase as $estudiante_clase){
            $sesion_estudiante = new SesionEstudiante;
            $sesion_estudiante->estudiante_clase_id = $estudiante_clase->id;
            $sesion_estudiante->sesion_id           = $this->id;
            $sesion_estudiante->save();
        }
        
        $inicio_clase = new InicioClase;
        $inicio_clase->sesion_id        = $this->id;
        $inicio_clase->inicio_sesion    = $inicio_sesion;
        $inicio_clase->fin_sesion       = $fin_sesion;
        $inicio_clase->save();
    }
    
    public function detener()
    {
        $this->auxiliar_terminal_id = null;
        $this->save();
        
        $sesiones_estudiante = SesionEstudiante::where('sesion_id', $this->id)
                               ->delete();
        
        $inicio_clase = InicioClase::where('sesion_id', $this->id);
        $inicio_clase->delete();
    }
}

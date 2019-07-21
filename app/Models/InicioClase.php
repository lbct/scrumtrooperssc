<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InicioClase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'inicio_clase';
    
    public function sesion()
    {
        return $this->belongsTo('App\Models\Sesion', 'sesion_id');
    }
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'auxiliar_laboratorio_id');
    }
    
    public function enCurso()
    {
        $en_curso = false;
        $fecha_actual = Carbon::now()->toDateTimeString();
        
        if($this->inicio_sesion <= $fecha_actual && $this->fin_sesion >= $fecha_actual)
            $en_curso = true; 
        
        return $en_curso;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clase;

class Gestion extends Model
{
    protected $primaryKey = 'id';
    protected $table      = 'gestion';
    
    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'periodo_id');
    }
    
    public function materia()
    {
        return $this->hasMany('App\Models\Materia', 'gestion_id', 'id');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'gestion_id', 'id');
    }
    
    public function esBorrable()
    {
        $borrable = true;
        $clase_iniciada = Clase::where('gestion_id', $this->id)
                          ->where('semana_actual_sesion', '>', 0)
                          ->first();
        
        if($clase_iniciada)
            $borrable = false;
        
        return $borrable;
    }
}

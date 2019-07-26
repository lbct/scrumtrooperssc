<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clase;

class Aula extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'aula';
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'aula_id', 'id');
    }
    
    public function esBorrable()
    {
        $borrable = true;
        
        $clase_iniciada = Clase::where('aula_id', $this->id)
                          ->where('semana_actual_sesion', '>', 0)
                          ->first();
        
        if($clase_iniciada)
            $borrable = false;
        
        return $borrable;
    }
}

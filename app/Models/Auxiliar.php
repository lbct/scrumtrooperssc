<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoDocenteAuxiliar;

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
        $esAuxiliarTerminal = false;
        
        $registrado = GrupoDocenteAuxiliar::where("auxiliar_id", $this->id)
                      ->where('grupo_docente_id', $grupo_docente_id)
                      ->first();
        
        if($registrado!=null)
            $esAuxiliarTerminal = true;
        
        return $esAuxiliarTerminal;
    }
}

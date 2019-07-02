<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\Clase;

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
    
    public function accesoClase($clase_id){
        $acceso_clase = false;
        
        $clase = Clase::find($clase_id);
        if($clase){
            $grupo_docente_id = Clase::find($clase_id)->grupo_docente_id;
            $acceso_clase = $this->esAuxiliarTerminal($grupo_docente_id);
        }
        
        return $acceso_clase;
    }
}

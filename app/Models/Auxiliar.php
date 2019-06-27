<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoDocenteAuxiliar;

class Auxiliar extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'AUXILIAR';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'AUXILIAR_ID', 'ID');
    }
    
    public function esAuxiliarLaboratorio($grupo_docente_id){
        $esAuxiliarLaboratorio = false;
        
        $registrado = GrupoDocenteAuxiliar::where("AUXILIAR_ID", $this->ID)
                      ->where('GRUPO_DOCENTE_ID', $grupo_docente_id)
                      ->first();
        
        if($registrado!=null)
            $esAuxiliarLaboratorio = true;
        
        return $esAuxiliarLaboratorio;
    }
}

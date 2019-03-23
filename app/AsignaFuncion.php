<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignaFuncion extends Model
{
    protected $table = 'ASIGNA_FUNCION';
    
    public function funcion()
    {
        return $this->belongsTo('App\Funcion', 'FUNCION_ID');
    }
    
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'ROL_ID');
    }
}

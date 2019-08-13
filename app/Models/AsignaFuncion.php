<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaFuncion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'asigna_funcion';
    
    public function funcion()
    {
        return $this->belongsTo('App\Models\Funcion', 'funcion_id');
    }
    
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', 'rol_id');
    }
}

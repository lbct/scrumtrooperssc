<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'FUNCION';
    
    public function asignaFuncion()
    {
        return $this->hasMany('App\Models\AsignaFuncion', 'FUNCION_ID', 'ID');
    }
}

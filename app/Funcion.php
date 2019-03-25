<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'FUNCION';
    
    public function asignaFuncion()
    {
        return $this->hasMany('App\AsignaFuncion', 'FUNCION_ID', 'ID');
    }
}

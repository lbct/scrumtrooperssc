<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'funcion';
    
    public function asignaFuncion()
    {
        return $this->hasMany('App\Models\AsignaFuncion', 'funcion_id', 'id');
    }
}

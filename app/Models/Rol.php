<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'rol';
    
    public function asignaRol()
    {
        return $this->hasMany('App\Models\AsignaRol', 'rol_id', 'id');
    }
    
    public function asignaFuncion()
    {
        return $this->hasMany('App\Models\AsignaFuncion', 'rol_id', 'id');
    }
}

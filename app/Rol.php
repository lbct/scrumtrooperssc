<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ROL';
    
    public function asignaRol()
    {
        return $this->hasMany('App\AsignaRol', 'ROL_ID', 'ID');
    }
    
    public function asignaFuncion()
    {
        return $this->hasMany('App\AsignaFuncion', 'ROL_ID', 'ID');
    }
}

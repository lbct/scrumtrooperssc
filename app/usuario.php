<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class usuario extends Model
{
    protected $table    = 'usuario';
=======
class Usuario extends Model
{
    protected $table = 'Usuario';
    
    public function administrador()
    {
        return $this->belongsTo('App\Administrador', 'ID');
    }
    
    public function auxiliar()
    {
        return $this->hasOne('App\Auxiliar', 'ID');
    }
    
    public function docente()
    {
        return $this->hasOne('App\Docente', 'ID');
    }
    
    public function estudiante()
    {
        return $this->hasOne('App\Estudiante', 'ID');
    }
>>>>>>> cesar
}

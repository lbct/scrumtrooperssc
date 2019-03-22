<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table    = 'usuario';
    protected $fillable = ['NOMBRE_USUARIO', 'CONTRASENA'];
}

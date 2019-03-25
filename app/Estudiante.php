<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'ESTUDIANTE';

    //protected $fillable = ['codigo_sis', 'contrasena', 'confirmacion_contrasena', 'nombre', 'apellido', 'correo', 'sexo', 'telefono', 'ci', 'fecha_nacimiento'];
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}

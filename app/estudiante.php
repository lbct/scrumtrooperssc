<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class estudiante extends Model
{
    protected $table    = 'estudiante';
=======
class Estudiante extends Model
{
    protected $table    = 'Estudiante';
    
    public function usuario()
    {
        return $this->hasOne('App\Usuario', 'ID', 'USUARIO_ID');
    }
>>>>>>> cesar
}

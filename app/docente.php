<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class docente extends Model
{
    protected $table    = 'docente';
=======
class Docente extends Model
{
    protected $table    = 'Docente';
    
    public function usuario()
    {
        return $this->hasOne('App\Usuario', 'ID', 'USUARIO_ID');
    }
>>>>>>> cesar
}

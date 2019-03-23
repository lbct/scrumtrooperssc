<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class administrador extends Model
{
    protected $table    = 'administrador';
=======
class Administrador extends Model
{
    protected $table = 'Administrador';
    
    public function usuario()
    {
        return $this->hasOne('App\Usuario', 'ID', 'USUARIO_ID');
    }
>>>>>>> cesar
}

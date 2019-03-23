<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class auxiliar extends Model
{
    protected $table    = 'auxiliar';
=======
class Auxiliar extends Model
{
    protected $table    = 'Auxiliar';
    
    public function usuario()
    {
        return $this->hasOne('App\Usuario', 'ID', 'USUARIO_ID');
    }
>>>>>>> cesar
}

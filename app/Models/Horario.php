<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'HORARIO';
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'HORARIO_ID', 'ID');
    }
}

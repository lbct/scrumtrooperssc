<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'horario';
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'horario_id', 'id');
    }
}

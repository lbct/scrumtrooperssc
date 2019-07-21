<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'aula';
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'aula_id', 'id');
    }
}

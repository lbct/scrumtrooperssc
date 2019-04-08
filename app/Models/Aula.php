<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'AULA';
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'AULA_ID', 'ID');
    }
}

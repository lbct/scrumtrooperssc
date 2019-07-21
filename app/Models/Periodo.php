<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'periodo';
    
    public function gestion()
    {
        return $this->hasMany('App\Models\Gestion', 'periodo_id', 'id');
    }
}

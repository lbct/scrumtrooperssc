<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'PERIODO';
    
    public function gestion()
    {
        return $this->hasMany('App\Models\Gestion', 'PERIODO_ID', 'ID');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocenteAuxiliar;

class GrupoDocenteAuxiliarSeeder extends Seeder
{
    public function run()
    {
        GrupoDocenteAuxiliar::create([
        	'grupo_docente_id' 		=>	1,
        	'auxiliar_id'		    =>	4,
        ]);
    }
}

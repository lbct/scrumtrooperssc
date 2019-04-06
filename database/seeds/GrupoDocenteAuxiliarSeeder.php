<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocenteAuxiliar;

class GrupoDocenteAuxiliarSeeder extends Seeder
{
    public function run()
    {
        GrupoDocenteAuxiliar::create([
            'GRUPO_DOCENTE_ID' 		    =>	1,
            'AUXILIAR_ID' 		        =>	1,
        ]);
        
        GrupoDocenteAuxiliar::create([
            'GRUPO_DOCENTE_ID' 		    =>	2,
            'AUXILIAR_ID' 		        =>	1,
        ]);
    }
}

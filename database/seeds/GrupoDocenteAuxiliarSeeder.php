<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocenteAuxiliar;

class GrupoDocenteAuxiliarSeeder extends Seeder
{
    public function run()
    {
        //WilsonAlcocer a Introducción a la programación
        GrupoDocenteAuxiliar::create([
            'GRUPO_DOCENTE_ID' 		    =>	1,
            'AUXILIAR_ID' 		        =>	2,
        ]);
        
        //WilsonAlcocer a Elementos
        GrupoDocenteAuxiliar::create([
            'GRUPO_DOCENTE_ID' 		    =>	2,
            'AUXILIAR_ID' 		        =>	2,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoADocente;

class GrupoADocenteSeeder extends Seeder
{
    public function run()
    {
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	1,
            'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	2,
            'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	1,
            'GRUPO_DOCENTE_ID' 	        =>	2,
        ]);
    }
}

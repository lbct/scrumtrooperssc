<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoADocente;

class GrupoADocenteSeeder extends Seeder
{
    public function run()
    {
        //Introducción a Leticia Blanco
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	1,
            'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        //Introducción a Rosemary Torrico
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	2,
            'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        //Elementos a Leticia Blanco
        GrupoADocente::create([
            'DOCENTE_ID' 		        =>	1,
            'GRUPO_DOCENTE_ID' 	        =>	2,
        ]);
    }
}

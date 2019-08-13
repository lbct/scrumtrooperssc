<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoADocente;

class GrupoADocenteSeeder extends Seeder
{
    public function run()
    {
        //Introducción a la programación
        GrupoADocente::create([
            'docente_id' 		        =>	1,
            'grupo_docente_id' 	        =>	1,
        ]);
        
        GrupoADocente::create([
            'docente_id' 		        =>	2,
            'grupo_docente_id' 	        =>	1,
        ]);
        
        GrupoADocente::create([
            'docente_id' 		        =>	3,
            'grupo_docente_id' 	        =>	1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\AsignarGrupoADocente;

class AsignarGrupoADocenteSeeder extends Seeder
{
    public function run()
    {
        AsignarGrupoADocente::create([
        'DOCENTE_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        AsignarGrupoADocente::create([
        'DOCENTE_ID' 		        =>	2,
        'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        AsignarGrupoADocente::create([
        'DOCENTE_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	2,
        ]);
    }
}

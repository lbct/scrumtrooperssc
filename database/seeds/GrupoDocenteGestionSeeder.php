<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocenteGestion;

class GrupoDocenteGestionSeeder extends Seeder
{
    public function run()
    {
        GrupoDocenteGestion::create([
        'GESTION_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        GrupoDocenteGestion::create([
        'GESTION_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	2,
        ]);
    }
}

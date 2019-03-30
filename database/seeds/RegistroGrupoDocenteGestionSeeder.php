<?php

use Illuminate\Database\Seeder;
use App\Models\RegistroGrupoDocenteGestion;

class RegistroGrupoDocenteGestionSeeder extends Seeder
{
    public function run()
    {
        RegistroGrupoDocenteGestion::create([
        'GESTION_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	1,
        ]);
        
        RegistroGrupoDocenteGestion::create([
        'GESTION_ID' 		        =>	1,
        'GRUPO_DOCENTE_ID' 	        =>	2,
        ]);
    }
}

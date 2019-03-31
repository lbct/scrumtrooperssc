<?php

use Illuminate\Database\Seeder;
use App\Models\RegistroEstudianteGrupoDocente;

class RegistroEstudianteGrupoDocenteSeeder extends Seeder
{
    public function run()
    {
        RegistroEstudianteGrupoDocente::create([
        'SESION_ID' 		                 =>	1,
        'ESTUDIANTE_ID' 	                 =>	1,
        'GRUPO_DOCENTE_ID' 	                 =>	1,
        ]);
        
        RegistroEstudianteGrupoDocente::create([
        'SESION_ID' 		                 =>	3,
        'ESTUDIANTE_ID' 	                 =>	2,
        'GRUPO_DOCENTE_ID' 	                 =>	1,
        ]);
    }
}

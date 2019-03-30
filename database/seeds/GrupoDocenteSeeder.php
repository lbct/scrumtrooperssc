<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocente;

class GrupoDocenteSeeder extends Seeder
{
    public function run()
    {
        GrupoDocente::create([
            'MATERIA_ID' 		        =>	1,
            'DETALLE_GRUPO_DOCENTE' 	=>	'Leticia Blanco y Rosemary Torrico impartirán esta materia',
        ]);
        
        GrupoDocente::create([
            'MATERIA_ID' 		        =>	2,
            'DETALLE_GRUPO_DOCENTE' 	=>	'Leticia Blanco impartirá esta materia',
        ]);
    }
}

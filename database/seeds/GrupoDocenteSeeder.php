<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocente;

class GrupoDocenteSeeder extends Seeder
{
    public function run()
    {
        GrupoDocente::create([
            'MATERIA_ID' 		        =>	1,
            'DETALLE_GRUPO_DOCENTE' 	=>	'INTRODUCCION A LA PROGRAMACION - Leticia Blanco, Rosemary Torrico',
        ]);
        
        GrupoDocente::create([
            'MATERIA_ID' 		        =>	2,
            'DETALLE_GRUPO_DOCENTE' 	=>	'ELEM. DE PROGRAMACION Y ESTRUC. DE DATOS - Leticia Blanco',
        ]);
    }
}

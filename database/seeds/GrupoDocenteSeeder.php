<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocente;

class GrupoDocenteSeeder extends Seeder
{
    public function run()
    {
        GrupoDocente::create([
            'MATERIA_ID' 		        =>	1,
            'DETALLE_GRUPO_DOCENTE' 	=>	'Leticia Blanco, Vladimir Costas, Corina Flores',
        ]);
    }
}

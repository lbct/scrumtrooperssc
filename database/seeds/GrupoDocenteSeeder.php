<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoDocente;

class GrupoDocenteSeeder extends Seeder
{
    public function run()
    {
        GrupoDocente::create([
            'materia_id' 		        =>	1,
            'detalle_grupo_docente' 	=>	'Leticia Blanco, Vladimir Costas, Corina Flores',
        ]);
    }
}

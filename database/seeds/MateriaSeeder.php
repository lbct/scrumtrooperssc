<?php

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run()
    {
        Materia::create([
            'gestion_id'            => 1,
            'codigo_materia' 		=> '2010010',
            'nombre_materia' 		=> 'Introducción a la programación',
            'detalle_materia' 		=> 'Primer semestre informática y sistemas',
        ]);
        
        Materia::create([
            'gestion_id'            => 1,
            'codigo_materia' 		=> '2010012',
            'nombre_materia' 		=> 'Elementos de Programación',
            'detalle_materia' 		=> 'Segundo semestre informática y sistemas',
        ]);
    }
}

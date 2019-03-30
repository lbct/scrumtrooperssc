<?php

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run()
    {
        Materia::create([
            'CODIGO_MATERIA' 		=>	'INF2010010',
            'NOMBRE_MATERIA' 		=>	'INTRODUCCION A LA PROGRAMACION',
            'DETALLE_MATERIA' 		=>	'INTRODUCCION A LA PROGRAMACION',
        ]);
        
        Materia::create([
            'CODIGO_MATERIA' 		=>	'INF2010003',
            'NOMBRE_MATERIA' 		=>	'ELEM. DE PROGRAMACION Y ESTRUC. DE DATOS',
            'DETALLE_MATERIA' 		=>	'ELEM. DE PROGRAMACION Y ESTRUC. DE DATOS',
        ]);
    }
}

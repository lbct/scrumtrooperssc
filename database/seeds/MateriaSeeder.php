<?php

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run()
    {
        Materia::create([
            'GESTION_ID'            => 1,
            'CODIGO_MATERIA' 		=> '2010010',
            'NOMBRE_MATERIA' 		=> 'INTRODUCCION A LA PROGRAMACION',
            'DETALLE_MATERIA' 		=> 'INTRODUCCION A LA PROGRAMACION',
        ]);
    }
}

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
            'nombre_materia' 		=> 'INTRODUCCION A LA PROGRAMACION',
            'detalle_materia' 		=> 'INTRODUCCION A LA PROGRAMACION',
        ]);
    }
}

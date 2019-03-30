<?php

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        Estudiante::create([
        	'USUARIO_ID' 		=>	5,
            'CODIGO_SIS' 		=>	'201400043',
        ]);
        
        Estudiante::create([
        	'USUARIO_ID' 		=>	6,
            'CODIGO_SIS' 		=>	'201400929',
        ]);
    }
}

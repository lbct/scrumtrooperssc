<?php

use Illuminate\Database\Seeder;
use App\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        Estudiante::create([
        	'USUARIO_ID' 		=>	5,
        ]);
        
        Estudiante::create([
        	'USUARIO_ID' 		=>	6,
        ]);
    }
}

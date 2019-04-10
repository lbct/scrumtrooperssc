<?php

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        //WilliamVelasquez
        Estudiante::create([
        	'USUARIO_ID' 		=>	4,
            'CODIGO_SIS' 		=>	'201400991',
        ]);
        
        //WilsonAlcocer
        Estudiante::create([
        	'USUARIO_ID' 		=>	5,
            'CODIGO_SIS' 		=>	'201403545',
        ]);
        
        //CesarQuiroga
        Estudiante::create([
        	'USUARIO_ID' 		=>	6,
            'CODIGO_SIS' 		=>	'201400043',
        ]);
        
        //AlexCardona
        Estudiante::create([
        	'USUARIO_ID' 		=>	7,
            'CODIGO_SIS' 		=>	'201400929',
        ]);
    }
}

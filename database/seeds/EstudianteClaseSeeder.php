<?php

use Illuminate\Database\Seeder;
use App\Models\EstudianteClase;

class EstudianteClaseSeeder extends Seeder
{
    public function run()
    {
        //CesarQuiroga Introducción a la Programación
        EstudianteClase::create([
            'CLASE_ID' 		                     =>	1,
            'ESTUDIANTE_ID' 	                 =>	3,
        ]);
        
        //CesarQuiroga Elementos
        EstudianteClase::create([
            'CLASE_ID' 		                     =>	4,
            'ESTUDIANTE_ID' 	                 =>	3,
        ]);
        
        //AlexCardona Introducción a la Programación
        EstudianteClase::create([
            'CLASE_ID'     		                 =>	2,
            'ESTUDIANTE_ID' 	                 =>	4,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\EstudianteClase;

class EstudianteClaseSeeder extends Seeder
{
    public function run()
    {
        EstudianteClase::create([
            'CLASE_ID' 		                     =>	1,
            'ESTUDIANTE_ID' 	                 =>	2,
        ]);
        
        EstudianteClase::create([
            'CLASE_ID'     		                 =>	3,
            'ESTUDIANTE_ID' 	                 =>	3,
        ]);
    }
}

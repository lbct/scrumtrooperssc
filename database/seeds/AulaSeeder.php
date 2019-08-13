<?php

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    public function run()
    {
        Aula::create([
        'codigo_aula' 		        =>	'CSLAB001',
        'nombre_aula' 	            =>	'LAB001',
        'capacidad_aula' 	        =>	35,
        ]);
        
        Aula::create([
        'codigo_aula' 		        =>	'CSLAB002',
        'nombre_aula' 	            =>	'LAB002',
        'capacidad_aula' 	        =>	35,
        ]);
        
        Aula::create([
        'codigo_aula' 		        =>	'CSLAB003',
        'nombre_aula' 	            =>	'LAB003',
        'capacidad_aula' 	        =>	35,
        ]);
    }
}

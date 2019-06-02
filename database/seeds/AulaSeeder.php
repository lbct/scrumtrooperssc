<?php

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    public function run()
    {
        Aula::create([
        'CODIGO_AULA' 		        =>	'CSLAB001',
        'NOMBRE_AULA' 	            =>	'LAB001',
        'DETALLE_AULA' 	            =>	'Laboratorio 001',
        ]);
        
        Aula::create([
        'CODIGO_AULA' 		        =>	'CSLAB002',
        'NOMBRE_AULA' 	            =>	'LAB002',
        'DETALLE_AULA' 	            =>	'Laboratorio 002',
        ]);
        
        Aula::create([
        'CODIGO_AULA' 		        =>	'CSLAB003',
        'NOMBRE_AULA' 	            =>	'LAB003',
        'DETALLE_AULA' 	            =>	'Laboratorio 003',
        ]);
    }
}

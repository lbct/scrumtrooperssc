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
        'detalle_aula' 	            =>	'Laboratorio 001',
        ]);
        
        Aula::create([
        'codigo_aula' 		        =>	'CSLAB002',
        'nombre_aula' 	            =>	'LAB002',
        'detalle_aula' 	            =>	'Laboratorio 002',
        ]);
        
        Aula::create([
        'codigo_aula' 		        =>	'CSLAB003',
        'nombre_aula' 	            =>	'LAB003',
        'detalle_aula' 	            =>	'Laboratorio 003',
        ]);
    }
}

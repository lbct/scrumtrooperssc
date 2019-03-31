<?php

use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    public function run()
    {
        Clase::create([
        'AULA_ID' 		                 =>	1,
        'HORARIO_ID' 	                 =>	1,
        'GRUPO_A_DOCENTE_ID' 	         =>	1,
        'DETALLE_CLASE' 	             =>	'Sesion de Leticia Blanco, Introducción a la programación, horario: 6:45 a 8:15 en LAB0001',
        'DIA' 	                         =>	'1',  
        ]);
        
        Clase::create([
        'AULA_ID' 		                 =>	3,
        'HORARIO_ID' 	                 =>	3,
        'GRUPO_A_DOCENTE_ID' 	         =>	1,
        'DETALLE_CLASE' 	             =>	'Sesion de Leticia Blanco, Introducción a la programación, horario: 9:45 a 11:45 en LAB0003',
        'DIA' 	                         =>	'1',
        ]);
        
        Clase::create([
        'AULA_ID' 		                 =>	2,
        'HORARIO_ID' 	                 =>	2,
        'GRUPO_A_DOCENTE_ID' 	         =>	2,
        'DETALLE_CLASE' 	             =>	'Sesion de Rosemary Torrico, Introducción a la programación, horario: 8:15 a 9:45 en LAB0002',
        'DIA' 	                         =>	'1',
        ]);
    }
}

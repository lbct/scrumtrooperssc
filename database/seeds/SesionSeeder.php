<?php

use Illuminate\Database\Seeder;
use App\Models\Sesion;

class SesionSeeder extends Seeder
{
    public function run()
    {
        Sesion::create([
        'AULA_ID' 		                 =>	1,
        'HORARIO_ID' 	                 =>	1,
        'AUXILIAR_ID' 	                 =>	1,
        'ASIGNAR_GRUPO_A_DOCENTE_ID' 	 =>	1,
        'DETALLE_SESION' 	             =>	'Sesion de Leticia Blanco, Introducción a la programación, auxiliar: William Velasquez, horario: 6:45 a 8:15 en LAB0001',   
        ]);
        
        Sesion::create([
        'AULA_ID' 		                 =>	3,
        'HORARIO_ID' 	                 =>	3,
        'AUXILIAR_ID' 	                 =>	1,
        'ASIGNAR_GRUPO_A_DOCENTE_ID' 	 =>	1,
        'DETALLE_SESION' 	             =>	'Sesion de Leticia Blanco, Introducción a la programación, auxiliar: William Velasquez, horario: 9:45 a 11:45 en LAB0003',   
        ]);
        
        Sesion::create([
        'AULA_ID' 		                 =>	2,
        'HORARIO_ID' 	                 =>	2,
        'AUXILIAR_ID' 	                 =>	1,
        'ASIGNAR_GRUPO_A_DOCENTE_ID' 	 =>	2,
        'DETALLE_SESION' 	             =>	'Sesion de Rosemary Torrico, Introducción a la programación, auxiliar: William Velasquez, horario: 8:15 a 9:45 en LAB0002',   
        ]);
    }
}

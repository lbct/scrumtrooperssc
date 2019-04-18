<?php

use Illuminate\Database\Seeder;
use App\Models\Sesion;

class SesionSeeder extends Seeder
{
    public function run()
    {
        Sesion::create([
        'CLASE_ID' 		                     =>	1,
        'AUXILIAR_ID' 		                 =>	1,
        'GUIA_PRACTICA' 	                 =>	'practica01.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Primera práctica. Subir un archivo .zip',
        ]);
         
        Sesion::create([
        'CLASE_ID' 		                     =>	1,
        'AUXILIAR_ID' 		                 =>	1,
        'GUIA_PRACTICA' 	                 =>	'practica02.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Segunda Práctica. Subir un archivo .zip',
        ]);
        
        Sesion::create([
        'CLASE_ID' 		                     =>	2,
        'AUXILIAR_ID' 		                 =>	1,
        'GUIA_PRACTICA' 	                 =>	'practica01.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Primera práctica. Subir un archivo .zip',
        ]);
    }
}

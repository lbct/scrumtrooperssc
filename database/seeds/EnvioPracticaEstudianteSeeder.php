<?php

use Illuminate\Database\Seeder;
use App\Models\EnvioPracticaEstudiante;

class EnvioPracticaEstudianteSeeder extends Seeder
{
    public function run()
    {
        EnvioPracticaEstudiante::create([
        'PRACTICA_ID' 		                 =>	1,
        'ESTUDIANTE_ID' 	                 =>	1,
        'EN_LABORATORIO' 	                 =>	true,
        'ARCHIVO_ENVIO'                      => 'CesarQuiroga01.zip',
        'DETALLE_ENVIO'                      => 'Compila',
        ]);
         
        EnvioPracticaEstudiante::create([
        'PRACTICA_ID' 		                 =>	1,
        'ESTUDIANTE_ID' 	                 =>	1,
        'EN_LABORATORIO' 	                 =>	false,
        'ARCHIVO_ENVIO'                      => 'CesarQuiroga02.zip',
        'DETALLE_ENVIO'                      => '',
        ]);
    }
}

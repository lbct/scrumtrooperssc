<?php

use Illuminate\Database\Seeder;
use App\Models\SesionEstudiante;

class SesionEstudianteSeeder extends Seeder
{
    public function run()
    {
        //Semana 1 Introducción CesarQuiroga
        SesionEstudiante::create([
            'SESION_ID' 		                 =>	1,
            'ESTUDIANTE_ID' 	                 =>	3,
            'ASISTENCIA_SESION'                  =>	true,
            'COMENTARIO_AUXILIAR'                =>	'Compila',
        ]);
         
        //Semana 2 Introducción CesarQuiroga
        SesionEstudiante::create([
            'SESION_ID' 		                 =>	2,
            'ESTUDIANTE_ID' 	                 =>	3,
            'ASISTENCIA_SESION' 	             =>	false,
            'COMENTARIO_AUXILIAR'                =>	'',
        ]);
        
        //Semana 1 Introducción AlexCardona
        SesionEstudiante::create([
            'SESION_ID' 		                 =>	3,
            'ESTUDIANTE_ID' 	                 =>	4,
            'ASISTENCIA_SESION'                  =>	true,
            'COMENTARIO_AUXILIAR'                =>	'Compila',
        ]);
    }
}

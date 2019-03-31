<?php

use Illuminate\Database\Seeder;
use App\Models\SesionEstudiante;

class SesionEstudianteSeeder extends Seeder
{
    public function run()
    {
        SesionEstudiante::create([
            'SESION_ID' 		                 =>	1,
            'ESTUDIANTE_ID' 	                 =>	2,
            'ASISTENCIA_SESION'                  =>	true,
            'COMENTARIO_AUXILIAR'                =>	'Compila',
        ]);
         
        SesionEstudiante::create([
            'SESION_ID' 		                 =>	2,
            'ESTUDIANTE_ID' 	                 =>	2,
            'ASISTENCIA_SESION' 	             =>	false,
            'COMENTARIO_AUXILIAR'                =>	'',
        ]);
    }
}

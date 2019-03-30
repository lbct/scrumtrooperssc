<?php

use Illuminate\Database\Seeder;
use App\Models\RregistroAsistenciaPracticaEstudiante;

class RregistroAsistenciaPracticaEstudianteSeeder extends Seeder
{
    public function run()
    {
        RregistroAsistenciaPracticaEstudiante::create([
        'PRACTICA_ID' 		                 =>	1,
        'ESTUDIANTE_ID' 	                 =>	1,
        'ASISTENCIA' 	                     =>	true,
        ]);
         
        RregistroAsistenciaPracticaEstudiante::create([
        'PRACTICA_ID' 		                 =>	2,
        'ESTUDIANTE_ID' 	                 =>	1,
        'ASISTENCIA' 	                     =>	false,
        ]);
    }
}

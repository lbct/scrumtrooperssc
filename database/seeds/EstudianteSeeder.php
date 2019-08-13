<?php

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        include 'poblacion/EstudianteSeeder.php';
    }
}

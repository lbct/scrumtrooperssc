<?php

use Illuminate\Database\Seeder;
use App\Models\FechaInscripcion;

class FechaInscripcionSeeder extends Seeder
{
    public function run()
    {
        FechaInscripcion::create([
            'inicio_inscripcion'    => '2019-08-01 00:00:00',
            'fin_inscripcion' 		=> '2019-08-14 00:00:00',
        ]);
    }
}

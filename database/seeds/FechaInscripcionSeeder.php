<?php

use Illuminate\Database\Seeder;
use App\Models\FechaInscripcion;

class FechaInscripcionSeeder extends Seeder
{
    public function run()
    {
        FechaInscripcion::create([
            'inicio_inscripcion'    => '2019-02-01 00:00:00',
            'fin_inscripcion' 		=> '2019-02-11 00:00:00',
        ]);
        
        FechaInscripcion::create([
            'inicio_inscripcion'    => '2019-08-04 00:00:00',
            'fin_inscripcion' 		=> '2019-08-16 00:00:00',
        ]);
    }
}

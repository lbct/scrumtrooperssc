<?php

use Illuminate\Database\Seeder;
use App\Models\FechaInscripcion;

class FechaInscripcionSeeder extends Seeder
{
    public function run()
    {
        FechaInscripcion::create([
            'inicio_inscripcion'    => '2019-06-28 16:18:37',
            'fin_inscripcion' 		=> '2019-06-30 23:59:59',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Gestion;

class GestionSeeder extends Seeder
{
    public function run()
    {
        Gestion::create([
        	'FECHA_INICIO' 		=>	'2019-01-01',
            'FECHA_FIN' 		=>	'2019-01-07',
            'NUMERO_SEMESTRE'   =>	1,
        ]);
    }
}

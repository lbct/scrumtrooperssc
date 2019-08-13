<?php

use Illuminate\Database\Seeder;
use App\Models\Gestion;

class GestionSeeder extends Seeder
{
    public function run()
    {
        Gestion::create([
        	'periodo_id' 	 =>	1,
            'anho_gestion' 	 =>	'2019',
            'activa'         => true,
            'inicio'         => '2019-02-01',
            'fin' 		     => '2019-07-01',
        ]);
        
        Gestion::create([
        	'periodo_id' 	 =>	2,
            'anho_gestion' 	 =>	'2019',
            'activa'         => false,
            'inicio'         => '2019-08-04',
            'fin' 		     => '2019-12-20',
        ]);
    }
}

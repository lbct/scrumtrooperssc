<?php

use Illuminate\Database\Seeder;
use App\IniciarSesion;

class IniciarSesionSeeder extends Seeder
{
    public function run()
    {
        IniciarSesion::create([
        	'USUARIO_ID' 		=>	'1',
            'FECHA_INICIO' 		=>	'2019-03-23 11:25:00',
            'FECHA_FIN' 		=>	'2019-03-23 12:00:00',
        ]);
        
        IniciarSesion::create([
        	'USUARIO_ID' 		=>	'1',
            'FECHA_INICIO' 		=>	'2019-03-23 12:01:00',
            'FECHA_FIN' 		=>	'2019-03-23 12:05:00',
        ]);
    }
}

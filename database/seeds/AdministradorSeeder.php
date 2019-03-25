<?php

use Illuminate\Database\Seeder;
use App\Administrador;

class AdministradorSeeder extends Seeder
{
    public function run()
    {
        Administrador::create([
        	'USUARIO_ID' 		=>	'1',
        ]);
    }
}

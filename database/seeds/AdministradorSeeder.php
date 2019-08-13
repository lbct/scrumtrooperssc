<?php

use Illuminate\Database\Seeder;
use App\Models\Administrador;

class AdministradorSeeder extends Seeder
{
    public function run()
    {
        Administrador::create([
        	'usuario_id' 		=>	1,
        ]);
    }
}

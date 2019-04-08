<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        Rol::create([
        	'DESCRIPCION' 		=>	'Administrador',
        ]);
        
        Rol::create([
        	'DESCRIPCION' 		=>	'Docente',
        ]);
        
        Rol::create([
        	'DESCRIPCION' 		=>	'Auxiliar',
        ]);
        
        Rol::create([
        	'DESCRIPCION' 		=>	'Estudiante',
        ]);
    }
}

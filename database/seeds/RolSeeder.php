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
        	'DESCRIPCION' 		=>	'AuxiliarLaboratorio',
        ]);
        
        Rol::create([
        	'DESCRIPCION' 		=>	'AuxiliarTerminal',
        ]);
        
        Rol::create([
        	'DESCRIPCION' 		=>	'Estudiante',
        ]);
    }
}

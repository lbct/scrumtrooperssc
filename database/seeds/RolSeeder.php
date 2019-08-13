<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        Rol::create([
        	'descripcion' 		=>	'Administrador',
        ]);
        
        Rol::create([
        	'descripcion' 		=>	'Docente',
        ]);
        
        Rol::create([
        	'descripcion' 		=>	'AuxiliarLaboratorio',
        ]);
        
        Rol::create([
        	'descripcion' 		=>	'AuxiliarTerminal',
        ]);
        
        Rol::create([
        	'descripcion' 		=>	'Estudiante',
        ]);
    }
}

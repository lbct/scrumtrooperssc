<?php

use Illuminate\Database\Seeder;
use App\Models\Funcion;

class FuncionSeeder extends Seeder
{
    public function run()
    {
        Funcion::create([
        	'DESCRIPCION' 		=>	'Añadir Administrador',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Administrador',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Administrador',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Añadir Gestión',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Gestión',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Gestión',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Añadir Docente',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Docente',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Docente',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Añadir Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Añadir Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Editar Estudiante',
        ]);
        
        Funcion::create([
        	'DESCRIPCION' 		=>	'Borrar Estudiante',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Funcion;

class FuncionSeeder extends Seeder
{
    public function run()
    {
        Funcion::create([
        	'descripcion' 		=>	'Añadir Administrador',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Administrador',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Administrador',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Añadir Gestión',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Gestión',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Gestión',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Añadir Docente',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Docente',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Docente',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Añadir Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Auxiliar De Laboratorio',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Añadir Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Auxiliar De Terminal',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Editar Estudiante',
        ]);
        
        Funcion::create([
        	'descripcion' 		=>	'Borrar Estudiante',
        ]);
    }
}

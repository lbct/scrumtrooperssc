<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        Usuario::create([
        	'USERNAME' 		    =>	'VladimirCostas',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Vladimir',
            'APELLIDO'			=>	'Costas',
            'CORREO'			=>	'v.costas@umss.edu.bo',
        ]);
        
        //Docente
        Usuario::create([
        	'USERNAME' 		    =>	'LeticiaBlanco',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Leticia',
            'APELLIDO'			=>	'Blanco',
            'CORREO'			=>	'leticia@memi.umss.edu.bo',
        ]);
        
        Usuario::create([
        	'USERNAME' 		    =>	'RosemaryTorrico',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Rosemary',
            'APELLIDO'			=>	'Torrico',
            'CORREO'			=>	'rosemary@cs.umss.edu.bo',
        ]);
        
        //Auxiliar Laboratorio
        Usuario::create([
        	'USERNAME' 		    =>	'WilliamVelasquez',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'William',
            'APELLIDO'			=>	'Velasquez',
            'CORREO'			=>	'william.velasquez@gmail.com',
        ]);
        
        //Auxiliar Terminal
        Usuario::create([
        	'USERNAME' 		    =>	'WilsonAlcocer',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Wilson',
            'APELLIDO'			=>	'Alcocer',
            'CORREO'			=>	'wilson.alcocer@gmail.com',
        ]);
        
        //Estudiante
        Usuario::create([
        	'USERNAME' 		    =>	'CesarQuiroga',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Cesar',
            'APELLIDO'			=>	'Quiroga',
            'CORREO'			=>	'cesar.a.quiroga.c@gmail.com',
        ]);
        
        Usuario::create([
        	'USERNAME' 		    =>	'AlexCardona',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Alex',
            'APELLIDO'			=>	'Cardona',
            'CORREO'			=>	'alex.cardona@gmail.com',
        ]);
    }
}

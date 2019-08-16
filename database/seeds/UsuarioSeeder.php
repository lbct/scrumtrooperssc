<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        //Administrador BernardoAdmin ID = 0
        Usuario::create([
        	'username' 		    =>	'admin',
        	'password'		    =>	Hash::make('L(*qzF0p'),
        	'nombre'			=>	'Administrador',
            'apellido'			=>	'',
            'correo'			=>	'scrumtrooperssc@gmail.com',
        ]);
        /*
        //Docente VladimirCostas ID = 2
        Usuario::create([
        	'username' 		    =>	'VladimirCostas',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Vladimir',
            'apellido'			=>	'Costas',
            'correo'			=>	'v.costas@umss.edu.bo',
        ]);
        
        //Docente LeticiaBlanco ID = 3
        Usuario::create([
        	'username' 		    =>	'LeticiaBlanco',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Leticia',
            'apellido'			=>	'Blanco',
            'correo'			=>	'leticia@memi.umss.edu.bo',
        ]);
        
        //Docente CorinaFlores ID = 4
        Usuario::create([
        	'username' 		    =>	'CorinaFlores',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Corina',
            'apellido'			=>	'Flores',
            'correo'			=>	'corina@memi.umss.edu.bo',
        ]);
        
        //Auxiliar Laboratorio ID = 5
        Usuario::create([
        	'username' 		    =>	'WilliamVelasquez',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'William',
            'apellido'			=>	'Velasquez',
            'correo'			=>	'william.velasquez@gmail.com',
        ]);
        
        
        //Auxiliar Laboratorio ID = 6
        Usuario::create([
        	'username' 		    =>	'CesarQuiroga',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Cesar',
            'apellido'			=>	'Quiroga',
            'correo'			=>	'cesar.a.quiroga.c@gmail.com',
        ]);
        
        //Auxiliar Laboratorio ID = 7
        Usuario::create([
        	'username' 		    =>	'AlexCardona',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Alex',
            'apellido'			=>	'Cardona',
            'correo'			=>	'alex.cardona@gmail.com',
        ]);
        
        //Auxiliar Terminal ID = 8
        Usuario::create([
        	'username' 		    =>	'WilsonAlcocer',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Wilson',
            'apellido'			=>	'Alcocer',
            'correo'			=>	'wilson.alcocer@gmail.com',
        ]);
        */
        //Estudiantes ID = 9
        //include 'poblacion/UsuarioSeeder.php';
    }
}

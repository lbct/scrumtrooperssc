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
        	'USERNAME' 		    =>	'BernardoCaussin',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Bernardo',
            'APELLIDO'			=>	'Caussin',
            'CORREO'			=>	'bernardo.caussin@umss.edu.bo',
        ]);
        
        //Docente VladimirCostas ID = 2
        Usuario::create([
        	'USERNAME' 		    =>	'VladimirCostas',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Vladimir',
            'APELLIDO'			=>	'Costas',
            'CORREO'			=>	'v.costas@umss.edu.bo',
        ]);
        
        //Docente LeticiaBlanco ID = 3
        Usuario::create([
        	'USERNAME' 		    =>	'LeticiaBlanco',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Leticia',
            'APELLIDO'			=>	'Blanco',
            'CORREO'			=>	'leticia@memi.umss.edu.bo',
        ]);
        
        //Docente CorinaFlores ID = 4
        Usuario::create([
        	'USERNAME' 		    =>	'CorinaFlores',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Corina',
            'APELLIDO'			=>	'Flores',
            'CORREO'			=>	'corina@memi.umss.edu.bo',
        ]);
        
        //Auxiliar Laboratorio ID = 5
        Usuario::create([
        	'USERNAME' 		    =>	'WilliamVelasquez',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'William',
            'APELLIDO'			=>	'Velasquez',
            'CORREO'			=>	'william.velasquez@gmail.com',
        ]);
        
        
        //Auxiliar Laboratorio ID = 6
        Usuario::create([
        	'USERNAME' 		    =>	'CesarQuiroga',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Cesar',
            'APELLIDO'			=>	'Quiroga',
            'CORREO'			=>	'cesar.a.quiroga.c@gmail.com',
        ]);
        
        //Auxiliar Laboratorio ID = 7
        Usuario::create([
        	'USERNAME' 		    =>	'AlexCardona',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Alex',
            'APELLIDO'			=>	'Cardona',
            'CORREO'			=>	'alex.cardona@gmail.com',
        ]);
        
        //Auxiliar Terminal ID = 8
        Usuario::create([
        	'USERNAME' 		    =>	'WilsonAlcocer',
        	'PASSWORD'		    =>	Hash::make('texto'),
        	'NOMBRE'			=>	'Wilson',
            'APELLIDO'			=>	'Alcocer',
            'CORREO'			=>	'wilson.alcocer@gmail.com',
        ]);
        
        //Estudiante ID = 9
        Usuario::create([
            'USERNAME' 		    => 'AldairNelsonTorrezQuiroga',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Aldair Nelson',
            'APELLIDO'		    => 'Torrez Quiroga',
            'CORREO'		    => 'Aldair.Nelson.Torrez.Quiroga@gmail.com',
        ]);
        //Estudiante ID = 10
        Usuario::create([
            'USERNAME' 		    => 'AlejandroFuentes',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Alejandro',
            'APELLIDO'		    => 'Fuentes',
            'CORREO'		    => 'Alejandro.Fuentes@gmail.com',
        ]);
        //Estudiante ID = 11
        Usuario::create([
            'USERNAME' 		    => 'AndresBravoAguilar',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Andres',
            'APELLIDO'		    => 'Bravo Aguilar',
            'CORREO'		    => 'Andres.Bravo.Aguilar@gmail.com',
        ]);
        //Estudiante ID = 12
        Usuario::create([
            'USERNAME' 		    => 'BernabeCatariColque',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Bernabe',
            'APELLIDO'		    => 'Catari Colque',
            'CORREO'		    => 'Bernabe.Catari.Colque@gmail.com',
        ]);
        //Estudiante ID = 13
        Usuario::create([
            'USERNAME' 		    => 'BrisaRojaBang',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Brisa',
            'APELLIDO'		    => 'Roja Bang',
            'CORREO'		    => 'Brisa.Roja.Bang@gmail.com',
        ]);
        //Estudiante ID = 14
        Usuario::create([
            'USERNAME' 		    => 'CarlosJosueVasquesHuanca',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Carlos Josue',
            'APELLIDO'		    => 'Vasques Huanca',
            'CORREO'		    => 'Carlos.Josue.Vasques.Huanca@gmail.com',
        ]);
        //Estudiante ID = 15
        Usuario::create([
            'USERNAME' 		    => 'DiegoGabricioSandovalChumacero',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Diego Fabricio',
            'APELLIDO'		    => 'Sandoval Chumacero',
            'CORREO'		    => 'Diego.Gabricio.Sandoval.Chumacero@gmail.com',
        ]);
        //Estudiante ID = 16
        Usuario::create([
            'USERNAME' 		    => 'EdilsonAliagaGarcia',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Edilson',
            'APELLIDO'		    => 'Aliaga Garcia',
            'CORREO'		    => 'Edilson.Aliaga.Garcia@gmail.com',
        ]);
        //Estudiante ID = 17
        Usuario::create([
            'USERNAME' 		    => 'GroverChuraFlores',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Grover',
            'APELLIDO'		    => 'Chura Flores',
            'CORREO'		    => 'Grover.Chura.Flores@gmail.com',
        ]);
        //Estudiante ID = 18
        Usuario::create([
            'USERNAME' 		    => 'GuillermoRojasBecerra',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Guillermo',
            'APELLIDO'		    => 'Rojas Becerra',
            'CORREO'		    => 'Guillermo.Rojas.Becerra@gmail.com',
        ]);
        //Estudiante ID = 19
        Usuario::create([
            'USERNAME' 		    => 'IsmaelPeraltaFernandez',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Ismael',
            'APELLIDO'		    => 'Peralta Fernandez',
            'CORREO'		    => 'Ismael.Peralta.Fernandez@gmail.com',
        ]);
        //Estudiante ID = 20
        Usuario::create([
            'USERNAME' 		    => 'IvanFloresCalle',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Ivan',
            'APELLIDO'		    => 'Flores Calle',
            'CORREO'		    => 'Ivan.Flores.Calle@gmail.com',
        ]);
        //Estudiante ID = 21
        Usuario::create([
            'USERNAME' 		    => 'IvanGomezOrellanda',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Ivan',
            'APELLIDO'		    => 'Gomez Orellanda',
            'CORREO'		    => 'Ivan.Gomez.Orellanda@gmail.com',
        ]);
        //Estudiante ID = 22
        Usuario::create([
            'USERNAME' 		    => 'JheisonLeon',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jheison',
            'APELLIDO'		    => 'Leon',
            'CORREO'		    => 'Jheison.Leon@gmail.com',
        ]);
        //Estudiante ID = 23
        Usuario::create([
            'USERNAME' 		    => 'JhoelMaicolMurilloCoca',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jhoel Maicol',
            'APELLIDO'		    => 'Murillo Coca',
            'CORREO'		    => 'Jhoel.Maicol.Murillo.Coca@gmail.com',
        ]);
        //Estudiante ID = 24
        Usuario::create([
            'USERNAME' 		    => 'JhoelRojasValdez',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jhoel',
            'APELLIDO'		    => 'Rojas Valdez',
            'CORREO'		    => 'Jhoel.Rojas.Valdez@gmail.com',
        ]);
        //Estudiante ID = 25
        Usuario::create([
            'USERNAME' 		    => 'JhonatanCuencaPilco',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jhonatan',
            'APELLIDO'		    => 'Cuenca Pilco',
            'CORREO'		    => 'Jhonatan.Cuenca.Pilco@gmail.com',
        ]);
        //Estudiante ID = 26
        Usuario::create([
            'USERNAME' 		    => 'JonathanMayreNoguera',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jonathan',
            'APELLIDO'		    => 'Mayre Noguera',
            'CORREO'		    => 'Jonathan.Mayre.Noguera@gmail.com',
        ]);
        //Estudiante ID = 27
        Usuario::create([
            'USERNAME' 		    => 'JoseQuiroz',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Jose',
            'APELLIDO'		    => 'Quiroz',
            'CORREO'		    => 'Jose.Quiroz@gmail.com',
        ]);
        //Estudiante ID = 28
        Usuario::create([
            'USERNAME' 		    => 'JosueInturiasS.',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Josue',
            'APELLIDO'		    => 'Inturias S.',
            'CORREO'		    => 'Josue.Inturias.S.@gmail.com',
        ]);
        //Estudiante ID = 29
        Usuario::create([
            'USERNAME' 		    => 'KatherineOrtizMamani',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Katherine',
            'APELLIDO'		    => 'Ortiz Mamani',
            'CORREO'		    => 'Katherine.Ortiz.Mamani@gmail.com',
        ]);
        //Estudiante ID = 30
        Usuario::create([
            'USERNAME' 		    => 'KevinRaulUreñaVidal',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Kevin Raul',
            'APELLIDO'		    => 'Ureña Vidal',
            'CORREO'		    => 'Kevin.Raul.Ureña.Vidal@gmail.com',
        ]);
        //Estudiante ID = 31
        Usuario::create([
            'USERNAME' 		    => 'KevinVillarroelChauca',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Kevin',
            'APELLIDO'		    => 'Villarroel Chauca',
            'CORREO'		    => 'Kevin.Villarroel.Chauca@gmail.com',
        ]);
        //Estudiante ID = 32
        Usuario::create([
            'USERNAME' 		    => 'LizbethPacariMamani',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Lizbeth',
            'APELLIDO'		    => 'Pacari Mamani',
            'CORREO'		    => 'Lizbeth.Pacari.Mamani@gmail.com',
        ]);
        //Estudiante ID = 33
        Usuario::create([
            'USERNAME' 		    => 'LuisVeidmarChoqueDuran',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Luis Veidmar',
            'APELLIDO'		    => 'Choque Duran',
            'CORREO'		    => 'Luis.Veidmar.Choque.Duran@gmail.com',
        ]);
        //Estudiante ID = 34
        Usuario::create([
            'USERNAME' 		    => 'MarcosJulioRamosCaceres',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Marcos Julio',
            'APELLIDO'		    => 'Ramos Caceres',
            'CORREO'		    => 'Marcos.Julio.Ramos.Caceres@gmail.com',
        ]);
        //Estudiante ID = 35
        Usuario::create([
            'USERNAME' 		    => 'MauricioHuaytaVillanueva',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Mauricio',
            'APELLIDO'		    => 'Huayta Villanueva',
            'CORREO'		    => 'Mauricio.Huayta.Villanueva@gmail.com',
        ]);
        //Estudiante ID = 36
        Usuario::create([
            'USERNAME' 		    => 'OmarAndresSelayaAntelo',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Omar Andres',
            'APELLIDO'		    => 'Selaya Antelo',
            'CORREO'		    => 'Omar.Andres.Selaya.Antelo@gmail.com',
        ]);
        //Estudiante ID = 37
        Usuario::create([
            'USERNAME' 		    => 'PabloRomanYaveMagne',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Pablo Roman',
            'APELLIDO'		    => 'Yave Magne',
            'CORREO'		    => 'Pablo.Roman.Yave.Magne@gmail.com',
        ]);
        //Estudiante ID = 38
        Usuario::create([
            'USERNAME' 		    => 'RodigroOliveraNavia',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Rodigro',
            'APELLIDO'		    => 'Olivera Navia',
            'CORREO'		    => 'Rodigro.Olivera.Navia@gmail.com',
        ]);
        //Estudiante ID = 39
        Usuario::create([
            'USERNAME' 		    => 'RolandoGuilleEscalera',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Rolando',
            'APELLIDO'		    => 'Guille Escalera',
            'CORREO'		    => 'Rolando.Guille.Escalera@gmail.com',
        ]);
        //Estudiante ID = 40
        Usuario::create([
            'USERNAME' 		    => 'SantiagoEdwingBravoB.',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Santiago Edwing',
            'APELLIDO'		    => 'Bravo B.',
            'CORREO'		    => 'Santiago.Edwing.Bravo.B.@gmail.com',
        ]);
        //Estudiante ID = 41
        Usuario::create([
            'USERNAME' 		    => 'UlisesMaldonadoEspejo',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Ulises',
            'APELLIDO'		    => 'Maldonado Espejo',
            'CORREO'		    => 'Ulises.Maldonado.Espejo@gmail.com',
        ]);
        //Estudiante ID = 42
        Usuario::create([
            'USERNAME' 		    => 'VeymarHinojosaJuan',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Veymar',
            'APELLIDO'		    => 'Hinojosa Juan',
            'CORREO'		    => 'Veymar.Hinojosa.Juan@gmail.com',
        ]);
        //Estudiante ID = 43
        Usuario::create([
            'USERNAME' 		    => 'WillmarHuarachiGarcia',
            'PASSWORD'		    => Hash::make('texto'),
            'NOMBRE'		    => 'Willmar',
            'APELLIDO'		    => 'Huarachi Garcia',
            'CORREO'		    => 'Willmar.Huarachi.Garcia@gmail.com',
        ]);
    }
}

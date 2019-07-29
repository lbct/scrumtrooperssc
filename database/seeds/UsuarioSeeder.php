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
        	'username' 		    =>	'BernardoCaussin',
        	'password'		    =>	Hash::make('texto'),
        	'nombre'			=>	'Bernardo',
            'apellido'			=>	'Caussin',
            'correo'			=>	'bernardo.caussin@umss.edu.bo',
        ]);
        
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
        
        //Estudiantes ID = 9
        Usuario::create([
        'username' => 'AldairNelsonTorrezQuiroga',
        'password' => Hash::make('texto'),
        'nombre'   => 'Aldair ',
        'apellido' => 'Nelson Torrez Quiroga',
        'correo'   => 'Aldair.Nelson.Torrez.Quiroga@gmail.com',
        ]);

        Usuario::create([
        'username' => 'AlejandroFuentes',
        'password' => Hash::make('texto'),
        'nombre'   => 'Alejandro ',
        'apellido' => 'Fuentes',
        'correo'   => 'Alejandro.Fuentes@gmail.com',
        ]);

        Usuario::create([
        'username' => 'AndresBravoAguilar',
        'password' => Hash::make('texto'),
        'nombre'   => 'Andres ',
        'apellido' => 'Bravo Aguilar',
        'correo'   => 'Andres.Bravo.Aguilar@gmail.com',
        ]);

        Usuario::create([
        'username' => 'BernabeCatariColque',
        'password' => Hash::make('texto'),
        'nombre'   => 'Bernabe ',
        'apellido' => 'Catari Colque',
        'correo'   => 'Bernabe.Catari.Colque@gmail.com',
        ]);

        Usuario::create([
        'username' => 'BrisaRojaBang',
        'password' => Hash::make('texto'),
        'nombre'   => 'Brisa ',
        'apellido' => 'Roja Bang',
        'correo'   => 'Brisa.Roja.Bang@gmail.com',
        ]);

        Usuario::create([
        'username' => 'CarlosJosueVasquesHuanca',
        'password' => Hash::make('texto'),
        'nombre'   => 'Carlos ',
        'apellido' => 'Josue Vasques Huanca',
        'correo'   => 'Carlos.Josue.Vasques.Huanca@gmail.com',
        ]);

        Usuario::create([
        'username' => 'DiegoFabricioSandovalChumacero',
        'password' => Hash::make('texto'),
        'nombre'   => 'Diego ',
        'apellido' => 'Fabricio Sandoval Chumacero',
        'correo'   => 'Diego.Fabricio.Sandoval.Chumacero@gmail.com',
        ]);

        Usuario::create([
        'username' => 'EdilsonAliagaGarcia',
        'password' => Hash::make('texto'),
        'nombre'   => 'Edilson ',
        'apellido' => 'Aliaga Garcia',
        'correo'   => 'Edilson.Aliaga.Garcia@gmail.com',
        ]);

        Usuario::create([
        'username' => 'GroverChuraFlores',
        'password' => Hash::make('texto'),
        'nombre'   => 'Grover ',
        'apellido' => 'Chura Flores',
        'correo'   => 'Grover.Chura.Flores@gmail.com',
        ]);

        Usuario::create([
        'username' => 'GuillermoRojasBecerra',
        'password' => Hash::make('texto'),
        'nombre'   => 'Guillermo ',
        'apellido' => 'Rojas Becerra',
        'correo'   => 'Guillermo.Rojas.Becerra@gmail.com',
        ]);

        Usuario::create([
        'username' => 'IsmaelPeraltaFernandez',
        'password' => Hash::make('texto'),
        'nombre'   => 'Ismael ',
        'apellido' => 'Peralta Fernandez',
        'correo'   => 'Ismael.Peralta.Fernandez@gmail.com',
        ]);

        Usuario::create([
        'username' => 'IvanFloresCalle',
        'password' => Hash::make('texto'),
        'nombre'   => 'Ivan ',
        'apellido' => 'Flores Calle',
        'correo'   => 'Ivan.Flores.Calle@gmail.com',
        ]);

        Usuario::create([
        'username' => 'IvanGomezOrellanda',
        'password' => Hash::make('texto'),
        'nombre'   => 'Ivan ',
        'apellido' => 'Gomez Orellanda',
        'correo'   => 'Ivan.Gomez.Orellanda@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JheisonLeon',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jheison ',
        'apellido' => 'Leon',
        'correo'   => 'Jheison.Leon@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JhoelMaicolMurilloCoca',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jhoel ',
        'apellido' => 'Maicol Murillo Coca',
        'correo'   => 'Jhoel.Maicol.Murillo.Coca@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JhoelRojasValdez',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jhoel ',
        'apellido' => 'Rojas Valdez',
        'correo'   => 'Jhoel.Rojas.Valdez@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JhonatanCuencaPilco',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jhonatan ',
        'apellido' => 'Cuenca Pilco',
        'correo'   => 'Jhonatan.Cuenca.Pilco@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JonathanMayreNoguera',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jonathan ',
        'apellido' => 'Mayre Noguera',
        'correo'   => 'Jonathan.Mayre.Noguera@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JoseQuiroz',
        'password' => Hash::make('texto'),
        'nombre'   => 'Jose ',
        'apellido' => 'Quiroz',
        'correo'   => 'Jose.Quiroz@gmail.com',
        ]);

        Usuario::create([
        'username' => 'JosueInturiasS.',
        'password' => Hash::make('texto'),
        'nombre'   => 'Josue ',
        'apellido' => 'Inturias S.',
        'correo'   => 'Josue.Inturias.S.@gmail.com',
        ]);

        Usuario::create([
        'username' => 'KatherineOrtizMamani',
        'password' => Hash::make('texto'),
        'nombre'   => 'Katherine ',
        'apellido' => 'Ortiz Mamani',
        'correo'   => 'Katherine.Ortiz.Mamani@gmail.com',
        ]);

        Usuario::create([
        'username' => 'KevinRaulUreñaVidal',
        'password' => Hash::make('texto'),
        'nombre'   => 'Kevin ',
        'apellido' => 'Raul Ureña Vidal',
        'correo'   => 'Kevin.Raul.Ureña.Vidal@gmail.com',
        ]);

        Usuario::create([
        'username' => 'KevinVillarroelChauca',
        'password' => Hash::make('texto'),
        'nombre'   => 'Kevin ',
        'apellido' => 'Villarroel Chauca',
        'correo'   => 'Kevin.Villarroel.Chauca@gmail.com',
        ]);

        Usuario::create([
        'username' => 'LizbethPacariMamani',
        'password' => Hash::make('texto'),
        'nombre'   => 'Lizbeth ',
        'apellido' => 'Pacari Mamani',
        'correo'   => 'Lizbeth.Pacari.Mamani@gmail.com',
        ]);

        Usuario::create([
        'username' => 'LuisVeidmarChoqueDuran',
        'password' => Hash::make('texto'),
        'nombre'   => 'Luis ',
        'apellido' => 'Veidmar Choque Duran',
        'correo'   => 'Luis.Veidmar.Choque.Duran@gmail.com',
        ]);

        Usuario::create([
        'username' => 'MarcosJulioRamosCaceres',
        'password' => Hash::make('texto'),
        'nombre'   => 'Marcos ',
        'apellido' => 'Julio Ramos Caceres',
        'correo'   => 'Marcos.Julio.Ramos.Caceres@gmail.com',
        ]);

        Usuario::create([
        'username' => 'MauricioHuaytaVillanueva',
        'password' => Hash::make('texto'),
        'nombre'   => 'Mauricio ',
        'apellido' => 'Huayta Villanueva',
        'correo'   => 'Mauricio.Huayta.Villanueva@gmail.com',
        ]);

        Usuario::create([
        'username' => 'OmarAndresSelayaAntelo',
        'password' => Hash::make('texto'),
        'nombre'   => 'Omar ',
        'apellido' => 'Andres Selaya Antelo',
        'correo'   => 'Omar.Andres.Selaya.Antelo@gmail.com',
        ]);

        Usuario::create([
        'username' => 'PabloRomanYaveMagne',
        'password' => Hash::make('texto'),
        'nombre'   => 'Pablo ',
        'apellido' => 'Roman Yave Magne',
        'correo'   => 'Pablo.Roman.Yave.Magne@gmail.com',
        ]);

        Usuario::create([
        'username' => 'RodrigoOliveraNavia',
        'password' => Hash::make('texto'),
        'nombre'   => 'Rodrigo ',
        'apellido' => 'Olivera Navia',
        'correo'   => 'Rodrigo.Olivera.Navia@gmail.com',
        ]);

        Usuario::create([
        'username' => 'RolandoGuilleEscalera',
        'password' => Hash::make('texto'),
        'nombre'   => 'Rolando ',
        'apellido' => 'Guille Escalera',
        'correo'   => 'Rolando.Guille.Escalera@gmail.com',
        ]);

        Usuario::create([
        'username' => 'SantiagoEdwingBravoB.',
        'password' => Hash::make('texto'),
        'nombre'   => 'Santiago ',
        'apellido' => 'Edwing Bravo B.',
        'correo'   => 'Santiago.Edwing.Bravo.B.@gmail.com',
        ]);

        Usuario::create([
        'username' => 'UlisesMaldonadoEspejo',
        'password' => Hash::make('texto'),
        'nombre'   => 'Ulises ',
        'apellido' => 'Maldonado Espejo',
        'correo'   => 'Ulises.Maldonado.Espejo@gmail.com',
        ]);

        Usuario::create([
        'username' => 'VeymarHinojosaJuan',
        'password' => Hash::make('texto'),
        'nombre'   => 'Veymar ',
        'apellido' => 'Hinojosa Juan',
        'correo'   => 'Veymar.Hinojosa.Juan@gmail.com',
        ]);

        Usuario::create([
        'username' => 'WillmarHuarachiGarcia',
        'password' => Hash::make('texto'),
        'nombre'   => 'Willmar ',
        'apellido' => 'Huarachi Garcia',
        'correo'   => 'Willmar.Huarachi.Garcia@gmail.com',
        ]);
    }
}

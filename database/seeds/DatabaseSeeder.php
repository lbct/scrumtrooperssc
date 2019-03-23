<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        
        $this->call(GestionSeeder::class);
        
        $this->call(UsuarioSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(DocenteSeeder::class);
        $this->call(AuxiliarSeeder::class);
        $this->call(EstudianteSeeder::class);
        
        $this->call(RolSeeder::class);
        $this->call(AsignaRolSeeder::class);
        
        $this->call(FuncionSeeder::class);
        $this->call(AsignaFuncionSeeder::class);
        
        $this->call(IniciarSesionSeeder::class);
        
        Model::reguard();
    }
}

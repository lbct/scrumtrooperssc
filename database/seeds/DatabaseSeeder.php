<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        
        $this->call(PeriodoSeeder::class);
        $this->call(GestionSeeder::class);
        
        $this->call(MateriaSeeder::class);
        $this->call(ResgistroGestionMateriaSeeder::class);
        
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
        
        $this->call(GrupoDocenteSeeder::class);
        $this->call(RegistroGrupoDocenteGestionSeeder::class);
        $this->call(AsignarGrupoADocenteSeeder::class);
        
        $this->call(AulaSeeder::class);
        $this->call(HorarioSeeder::class);
        $this->call(SesionSeeder::class);
        
        $this->call(RegistroEstudianteGrupoDocenteSeeder::class);
        
        $this->call(PracticaSeeder::class);
        
        $this->call(RregistroAsistenciaPracticaEstudianteSeeder::class);
        
        $this->call(EnvioPracticaEstudianteSeeder::class);
        
        Model::reguard();
    }
}

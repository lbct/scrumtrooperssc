<?php

use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    public function run()
    {
        Horario::create([
        'hora_inicio' 		        =>	'06:45:00',
        'hora_fin' 	                =>	'08:15:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'08:15:00',
        'hora_fin' 	                =>	'09:45:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'09:45:00',
        'hora_fin' 	                =>	'11:15:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'11:15:00',
        'hora_fin' 	                =>	'12:45:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'12:45:00',
        'hora_fin' 	                =>	'14:15:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'14:15:00',
        'hora_fin' 	                =>	'15:45:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'15:45:00',
        'hora_fin' 	                =>	'17:15:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'17:15:00',
        'hora_fin' 	                =>	'18:45:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'18:45:00',
        'hora_fin' 	                =>	'20:15:00',
        ]);
        
        Horario::create([
        'hora_inicio' 		        =>	'20:15:00',
        'hora_fin' 	                =>	'21:45:00',
        ]);
    }
}

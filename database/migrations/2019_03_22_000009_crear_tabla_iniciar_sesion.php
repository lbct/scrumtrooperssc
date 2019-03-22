<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaIniciarSesion extends Migration
{
    public function up()
    {
        Schema::create('INICIAR_SESION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->date('FECHA_INICIO_SESION');
            $table->date('FECHA_FIN_SESION');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('INICIAR_SESION');
    }
}

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
            $table->integer('USUARIO_ID')->unsigned();
            
            $table->integer('PID');
            $table->dateTime('FECHA_INICIO');
            $table->dateTime('FECHA_FIN');
            $table->timestamps();
            
            $table->foreign('USUARIO_ID')->references('ID')->on('USUARIO')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('INICIAR_SESION');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaIniciarSesion extends Migration
{
    public function up()
    {
        Schema::create('iniciar_sesion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            
            $table->dateTime('fecha');
            $table->timestamps();
            
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('iniciar_sesion');
    }
}

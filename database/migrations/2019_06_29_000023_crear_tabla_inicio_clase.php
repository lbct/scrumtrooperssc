<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInicioClase extends Migration
{
    public function up()
    {
        Schema::create('inicio_clase', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('sesion_id')->unsigned();
            $table->integer('auxiliar_laboratorio_id')->unsigned()->nullable();
            
            $table->dateTime('inicio_sesion');
            $table->dateTime('fin_sesion');
            $table->timestamps();
            
            $table->foreign('sesion_id')->references('id')->on('sesion')->onDelete('cascade');
            $table->foreign('auxiliar_laboratorio_id')->references('id')->on('auxiliar')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('inicio_clase');
    }
}

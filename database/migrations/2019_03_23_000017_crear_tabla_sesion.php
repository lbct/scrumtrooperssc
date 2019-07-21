<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSesion extends Migration
{
    public function up()
    {
        Schema::create('sesion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('clase_id')->unsigned();
            $table->integer('auxiliar_terminal_id')->unsigned()->nullable();
            $table->integer('guia_practica_id')->unsigned();
            
            $table->integer('semana');
            $table->timestamps();
            
            $table->foreign('clase_id')->references('id')->on('clase')->onDelete('cascade');
            $table->foreign('auxiliar_terminal_id')->references('id')->on('auxiliar')->onDelete('cascade');
            $table->foreign('guia_practica_id')->references('id')->on('guia_practica')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::drop('sesion');
    }
}

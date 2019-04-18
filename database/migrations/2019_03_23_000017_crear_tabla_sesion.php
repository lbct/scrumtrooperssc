<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSesion extends Migration
{
    public function up()
    {
        Schema::create('SESION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('CLASE_ID')->unsigned();
            $table->integer('AUXILIAR_ID')->unsigned();
            $table->integer('GUIA_PRACTICA_ID')->unsigned();
            
            $table->integer('SEMANA');
            $table->timestamps();
            
            $table->foreign('CLASE_ID')->references('ID')->on('CLASE')->onDelete('cascade');
            $table->foreign('AUXILIAR_ID')->references('ID')->on('AUXILIAR')->onDelete('cascade');
            $table->foreign('GUIA_PRACTICA_ID')->references('ID')->on('GUIA_PRACTICA')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::drop('SESION');
    }
}

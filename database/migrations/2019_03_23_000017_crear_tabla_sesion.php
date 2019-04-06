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
            
            $table->string('GUIA_PRACTICA',255);
            $table->string('DETALLE_PRACTICA');
            $table->timestamps();
            
            $table->foreign('CLASE_ID')->references('ID')->on('CLASE')->onDelete('cascade');
            $table->foreign('AUXILIAR_ID')->references('ID')->on('AUXILIAR')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::drop('SESION');
    }
}

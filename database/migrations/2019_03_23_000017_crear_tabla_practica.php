<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPractica extends Migration
{
    public function up()
    {
        Schema::create('PRACTICA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('SESION_ID')->unsigned();
            
            $table->string('GUIA_PRACTICA',255);
            $table->string('DETALLE_PRACTICA');
            $table->timestamps();
            
            $table->foreign('SESION_ID')->references('ID')->on('SESION')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::drop('PRACTICA');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroGestionMateria extends Migration
{
    public function up()
    {
        Schema::create('REGISTRO_GESTION_MATERIA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GESTION_ID')->unsigned();
            $table->integer('MATERIA_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('GESTION_ID')->references('ID')->on('GESTION')->onDelete('cascade');
            $table->foreign('MATERIA_ID')->references('ID')->on('MATERIA')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('REGISTRO_GESTION_MATERIA');
    }
}

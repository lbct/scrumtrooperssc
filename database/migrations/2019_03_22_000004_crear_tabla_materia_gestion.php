<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMateriaGestion extends Migration
{
    public function up()
    {
        Schema::create('MATERIA_GESTION', function (Blueprint $table) {
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
        Schema::drop('MATERIA_GESTION');
    }
}

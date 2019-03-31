<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEstudianteClase extends Migration
{
    public function up()
    {
        Schema::create('ESTUDIANTE_CLASE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('CLASE_ID')->unsigned();
            $table->integer('ESTUDIANTE_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('CLASE_ID')->references('ID')->on('CLASE')->onDelete('cascade');
            $table->foreign('ESTUDIANTE_ID')->references('ID')->on('ESTUDIANTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('ESTUDIANTE_CLASE');
    }
}

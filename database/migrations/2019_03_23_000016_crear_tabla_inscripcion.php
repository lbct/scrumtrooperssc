<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInscripcion extends Migration
{
    public function up()
    {
        Schema::create('INSCRIPCION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GRUPO_A_DOCENTE_ID')->unsigned();
            $table->integer('ESTUDIANTE_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('ESTUDIANTE_ID')->references('ID')->on('ESTUDIANTE')->onDelete('cascade');
            $table->foreign('GRUPO_A_DOCENTE_ID')->references('ID')->on('GRUPO_A_DOCENTE')->onDelete('cascade');
            
            $table->unique(['GRUPO_A_DOCENTE_ID', 'ESTUDIANTE_ID']);
        });
    }

    public function down()
    {
        Schema::drop('INSCRIPCION');
    }
}

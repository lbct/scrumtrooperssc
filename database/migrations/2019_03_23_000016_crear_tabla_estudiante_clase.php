<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEstudianteClase extends Migration
{
    public function up()
    {
        Schema::create('estudiante_clase', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('clase_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->integer('grupo_a_docente_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('clase_id')->references('id')->on('clase')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade');
            $table->foreign('grupo_a_docente_id')->references('id')->on('grupo_a_docente')->onDelete('cascade');
            
            $table->unique(['clase_id', 'estudiante_id']);
        });
    }

    public function down()
    {
        Schema::drop('estudiante_clase');
    }
}

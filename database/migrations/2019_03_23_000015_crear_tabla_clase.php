<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClase extends Migration
{
    public function up()
    {
        Schema::create('CLASE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GESTION_ID')->unsigned();
            $table->integer('AULA_ID')->unsigned();
            $table->integer('HORARIO_ID')->unsigned();
            $table->integer('GRUPO_A_DOCENTE_ID')->unsigned();
            
            $table->string('DETALLE_CLASE',255);
            $table->tinyInteger('DIA');
            $table->timestamps();
            
            $table->foreign('GESTION_ID')->references('ID')->on('GESTION')->onDelete('cascade');
            $table->foreign('AULA_ID')->references('ID')->on('AULA')->onDelete('cascade');
            $table->foreign('HORARIO_ID')->references('ID')->on('HORARIO')->onDelete('cascade');
            $table->foreign('GRUPO_A_DOCENTE_ID')->references('ID')->on('GRUPO_A_DOCENTE')->onDelete('cascade');
            
            $table->unique(['GESTION_ID', 'AULA_ID', 'HORARIO_ID', 'DIA']);
        });
    }

    public function down()
    {
        Schema::drop('CLASE');
    }
}

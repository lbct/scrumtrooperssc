<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClase extends Migration
{
    public function up()
    {
        Schema::create('clase', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('gestion_id')->unsigned();
            $table->integer('aula_id')->unsigned();
            $table->integer('horario_id')->unsigned();
            $table->integer('grupo_docente_id')->unsigned();
            
            $table->string('detalle_clase',255);
            $table->tinyInteger('dia');
            $table->tinyInteger('semana_actual_sesion')->default(0);
            $table->timestamps();
            
            $table->foreign('gestion_id')->references('id')->on('gestion')->onDelete('cascade');
            $table->foreign('aula_id')->references('id')->on('aula')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horario')->onDelete('cascade');
            $table->foreign('grupo_docente_id')->references('id')->on('grupo_docente')->onDelete('cascade');
            
            $table->unique(['gestion_id', 'aula_id', 'horario_id', 'dia']);
        });
    }

    public function down()
    {
        Schema::drop('clase');
    }
}

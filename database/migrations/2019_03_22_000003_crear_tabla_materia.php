<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMateria extends Migration
{
    public function up()
    {
        Schema::create('MATERIA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GESTION_ID')->unsigned();
            
            $table->string('CODIGO_MATERIA', 10);
            $table->string('NOMBRE_MATERIA', 45);
            $table->string('DETALLE_MATERIA', 255);
            $table->timestamps();
            
            $table->foreign('GESTION_ID')->references('ID')->on('GESTION')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('MATERIA');
    }
}

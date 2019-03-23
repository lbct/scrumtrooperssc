<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsignaFuncion extends Migration
{
    public function up()
    {
        Schema::create('ASIGNA_FUNCION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('ROL_ID')->unsigned();
            $table->integer('FUNCION_ID')->unsigned();
            
            $table->dateTime('FECHA');
            $table->timestamps();
            
            $table->foreign('ROL_ID')->references('ID')->on('ROL')->onDelete('cascade');
            $table->foreign('FUNCION_ID')->references('ID')->on('FUNCION')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('ASIGNA_FUNCION');
    }
}

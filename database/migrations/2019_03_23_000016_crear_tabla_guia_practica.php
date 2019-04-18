<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGuiaPractica extends Migration
{
    public function up()
    {
        Schema::create('GUIA_PRACTICA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->string('ARCHIVO',255);
            $table->string('DETALLE',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('GUIA_PRACTICA');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGuiaPractica extends Migration
{
    public function up()
    {
        Schema::create('guia_practica', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('archivo',255);
            $table->string('detalle',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('guia_practica');
    }
}

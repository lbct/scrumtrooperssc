<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFuncion extends Migration
{
    public function up()
    {
        Schema::create('funcion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('descripcion', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('funcion');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFuncion extends Migration
{
    public function up()
    {
        Schema::create('FUNCION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->string('DESCRIPCION', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('FUNCION');
    }
}

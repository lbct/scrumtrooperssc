<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAula extends Migration
{
    public function up()
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('codigo_aula',25)->unique();
            $table->string('nombre_aula',255);
            $table->unsignedMediumInteger('capacidad_aula')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('aula');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAula extends Migration
{
    public function up()
    {
        Schema::create('AULA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->string('CODIGO_AULA', 15);
            $table->string('NOMBRE_AULA', 15);
            $table->string('DETALLE_AULA', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('AULA');
    }
}

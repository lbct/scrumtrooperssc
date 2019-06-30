<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEnvioPractica extends Migration
{
    public function up()
    {
        Schema::create('envio_practica', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('sesion_estudiante_id')->unsigned();
            
            $table->boolean('en_laboratorio');
            $table->string('archivo',255);
            $table->timestamps();
            
            $table->foreign('sesion_estudiante_id')->references('id')->on('sesion_estudiante')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('envio_practica');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersona extends Migration
{
    public function up()
    {
        Schema::create('PERSONA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('USUARIO_ID')->unsigned();
            
            $table->string('NOMBRE', 100);
            $table->string('APELLIDO', 100);
            $table->string('CODIGO_SIS', 15);
            $table->string('CORREO', 255);
            $table->string('SEXO',1);
            $table->string('TELEFONO');
            $table->string('CI');
            $table->date('FECHA_NACIMINETO_PERSONA');
            $table->timestamps();
            
            $table->foreign('USUARIO_ID')->references('ID')->on('USUARIO')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('PERSONA');
    }
}

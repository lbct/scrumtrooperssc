<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGestion extends Migration
{
    public function up()
    {
        Schema::create('GESTION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->date('FECHA_INICIO');
            $table->date('FECHA_FIN');
            $table->string('NUMERO_SEMESTRE',1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('GESTION');
    }
}

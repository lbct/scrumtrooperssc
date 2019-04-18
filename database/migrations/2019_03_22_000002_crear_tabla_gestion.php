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
            $table->integer('PERIODO_ID')->unsigned();
            
            $table->string('ANO_GESTION',4);
            $table->timestamps();
            
            $table->foreign('PERIODO_ID')->references('ID')->on('PERIODO')->onDelete('cascade');
            
            $table->unique(['ANO_GESTION', 'PERIODO_ID']);
        });
    }

    public function down()
    {
        Schema::drop('GESTION');
    }
}

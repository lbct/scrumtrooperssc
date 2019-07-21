<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGestion extends Migration
{
    public function up()
    {
        Schema::create('gestion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('periodo_id')->unsigned();
            
            $table->string('anho_gestion',4);
            $table->boolean('activa')->default(0);;
            $table->timestamps();
            
            $table->foreign('periodo_id')->references('id')->on('periodo')->onDelete('cascade');
            
            $table->unique(['anho_gestion', 'periodo_id']);
        });
    }

    public function down()
    {
        Schema::drop('gestion');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEntrenadorDeportista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('entrenador_deportista', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Entrenador_Id')->unsigned();
            $table->integer('Deportista_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('Entrenador_Id')->references('Id')->on('entrenador');
            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrenador_deportista', function(Blueprint $table){
            $table->dropForeign('Entrenador_Id');
            $table->dropForeign('Deportista_Id');
        });    
        Schema::drop('entrenador_deportista');
    }
}
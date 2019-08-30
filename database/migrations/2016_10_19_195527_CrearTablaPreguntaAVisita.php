<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPreguntaAVisita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('visita_pregunta_a', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('Visita_Id')->unsigned();
            $table->string('PreguntaA_Id');
            $table->string('Respuesta');
            $table->string('Descripcion')->nullable();

            $table->foreign('Visita_Id')->references('Id')->on('visita_domiciliaria');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visita_pregunta_a', function(Blueprint $table){
            $table->dropForeign('Visita_Id');
        });    
        Schema::drop('visita_pregunta_a');
    }
}
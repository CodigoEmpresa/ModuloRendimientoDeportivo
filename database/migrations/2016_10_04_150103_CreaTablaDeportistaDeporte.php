<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaDeportistaDeporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deportista_deporte', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Agrupacion_Id')->unsigned();
            $table->integer('Deporte_Id')->unsigned();
            $table->integer('Modalidad_Id')->unsigned();
            $table->integer('Club_Id')->unsigned();
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Agrupacion_Id')->references('Id')->on('agrupacion');
            $table->foreign('Deporte_Id')->references('Id')->on('deporte');
            $table->foreign('Modalidad_Id')->references('Id')->on('modalidad');
            //$table->foreign('Club_Id')->references('Id')->on('club');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_deporte', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Agrupacion_Id');
            $table->dropForeign('Deporte_Id');
            $table->dropForeign('Modalidad_Id');
            $table->dropForeign('Club_Id');
        });    
        Schema::drop('deportista_deporte');
    }
}
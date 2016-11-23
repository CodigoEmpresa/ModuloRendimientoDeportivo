<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEventoDeporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('evento_deporte', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Evento_Id')->unsigned();
            $table->integer('Deporte_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('Evento_Id')->references('Id')->on('evento');
            $table->foreign('Deporte_Id')->references('Id')->on('deporte');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_deporte', function(Blueprint $table){
            $table->dropForeign('Evento_Id');
            $table->dropForeign('Deporte_Id');            
        });    
        Schema::drop('evento_deporte');
    }
}
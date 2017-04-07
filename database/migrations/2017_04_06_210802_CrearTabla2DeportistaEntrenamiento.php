<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTabla2DeportistaEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('deportista_entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Deportista_Id')->unsigned();            
            $table->integer('Entrenamiento_Id')->unsigned();
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
        Schema::table('deportista_entrenamiento', function(Blueprint $table){
            $table->dropForeign('Deportista_Id')->references('Id');
            $table->dropForeign('Entrenamiento_Id')->references('Id');
        });    
        Schema::drop('deportista_entrenamiento');
    }
}
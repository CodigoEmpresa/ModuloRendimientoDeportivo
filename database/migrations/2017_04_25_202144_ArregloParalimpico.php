<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArregloParalimpico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Arreglos a la tabla DEPORTES
        Schema::create('deporte_discapacidad', function(Blueprint $table){       
            $table->increments('Id');
            $table->integer('Discapacidad_Id')->unsigned();
            $table->integer('Deporte_Id')->unsigned();
            $table->timestamps();

            $table->foreign('Discapacidad_Id')->references('Id')->on('discapacidad');
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
        Schema::table('deporte_discapacidad', function(Blueprint $table){
            $table->dropForeign('Discapacidad_Id');
            $table->dropForeign('Deporte_Id');            
        });    
        Schema::drop('deporte_discapacidad');
    }
}
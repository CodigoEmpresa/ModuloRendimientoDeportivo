<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMetodologoAgrupacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodologo_agrupacion', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Persona_Id');
            $table->integer('Agrupacion_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('Agrupacion_Id')->references('Id')->on('agrupacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metodologo_agrupacion', function(Blueprint $table){
            $table->dropForeign('Agrupacion_Id');
        });    
        Schema::drop('metodologo_agrupacion');
    }
}
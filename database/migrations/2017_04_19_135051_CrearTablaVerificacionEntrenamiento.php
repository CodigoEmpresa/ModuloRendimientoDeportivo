<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVerificacionEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificacion_entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Entrenamiento_Id')->unsigned();            
            $table->date('Fecha');
            $table->integer('Numero_Dia');
            $table->string('P_1');
            $table->string('P_2');
            $table->string('P_3');
            $table->timestamps();            
            
            $table->foreign('Entrenamiento_Id')->references('Id')->on('entrenamiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verificacion_entrenamiento', function(Blueprint $table){
            $table->dropForeign('Entrenamiento_Id')->references('Id');
        });    
        Schema::drop('verificacion_entrenamiento');
    }
}
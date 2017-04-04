<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Entrenador_Id')->unsigned();            
            $table->integer('Horario_Id')->unsigned();
            $table->string('Lugar_Entrenamiento');
            $table->date('Fecha_Inicio');
            $table->date('Fecha_Fin');            
            $table->string('Hora_Inicio');
            $table->string('Hora_Fin');
            $table->timestamps();            
            
            $table->foreign('Entrenador_Id')->references('Id')->on('entrenador');
            $table->foreign('Horario_Id')->references('Id')->on('horario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrenamiento', function(Blueprint $table){
            $table->dropForeign('Entrenador_Id');
            $table->dropForeign('Horario_Id');
        });    
        Schema::drop('entrenamiento');
    }
}
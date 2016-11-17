<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Clasificacion_Deportista_Id')->unsigned();
            $table->integer('Tipo_Nivel_Id')->unsigned();            
            $table->string('Nombre_Evento');
            $table->timestamps();

            $table->foreign('Clasificacion_Deportista_Id')->references('Id')->on('clasificacion_deportista');
            $table->foreign('Tipo_Nivel_Id')->references('Id')->on('tipo_nivel');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento', function(Blueprint $table){
            $table->dropForeign('Clasificacion_Deportista_Id');
            $table->dropForeign('Tipo_Nivel_Id');            
        });    
        Schema::drop('evento');
    }
}
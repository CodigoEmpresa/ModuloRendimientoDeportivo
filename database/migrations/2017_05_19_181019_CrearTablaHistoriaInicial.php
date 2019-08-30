<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaHistoriaInicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('historia_inicial', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Ocupacion_Id')->unsigned();
            $table->integer('NivelEstudio_Id')->unsigned();
            $table->integer('Dominancia_Id')->unsigned();
            $table->integer('Medico_Id')->unsigned();
            $table->string('Edad_Deportiva');            
            $table->string('Nombre_Padre');
            $table->string('Nombre_Madre');
            $table->string('Entrenamiento_Continuo_Preg');
            $table->string('Plan_Entrenamiento_Preg');            
            $table->string('Nombre_Acudiente');
            $table->string('Telefono_Acudiente');
            $table->string('Nombre_Responsable');
            $table->string('Telefono_Responsable');            
            
            $table->timestamps();
            
            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Ocupacion_Id')->references('Id')->on('ocupacion');
            $table->foreign('NivelEstudio_Id')->references('Id')->on('nivel_estudio');
            $table->foreign('Dominancia_Id')->references('Id')->on('dominancia');
            //$table->foreign('Medico_Id')->references('Id')->on('medico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historia_inicial', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Ocupacion_Id');
            $table->dropForeign('NivelEstudio_Id');
            $table->dropForeign('Dominancia_Id');
            $table->dropForeign('Medico_Id');
        });    
        Schema::drop('historia_inicial');
    }
}
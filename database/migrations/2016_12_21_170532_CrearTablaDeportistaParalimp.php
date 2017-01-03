<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaParalimp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deportista_paralimpico', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Discapacidad_Id')->unsigned();
            $table->integer('Diagnostico_Id')->unsigned();            
            $table->integer('Clasificacion_Funcional_Id')->unsigned();                        
            $table->integer('Silla_Id');
            $table->integer('Uso_Silla_Id')->nullable();            
            $table->string('Auxiliar_Id')->nullable();
            $table->integer('Clasificacion_Funcional_Internacional_Id');            
            $table->string('EdadAdquirido');
            $table->date('Fecha_Clasificacion');
            $table->string('Evento_Clasificacion');
            $table->string('EdadDeportiva');            
            $table->string('Resultado_Nacional');
            $table->string('Resultado_Internacional');

            $table->timestamps();
            
            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Discapacidad_Id')->references('Id')->on('discapacidad');
            $table->foreign('Diagnostico_Id')->references('Id')->on('diagnostico');
            $table->foreign('Clasificacion_Funcional_Id')->references('Id')->on('clasificacion_funcional');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_paralimpico', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Discapacidad_Id');            
            $table->dropForeign('Diagnostico_Id');            
            $table->dropForeign('Clasificacion_Funcional_Id');            
        });    
        Schema::drop('deportista_paralimpico');
    }
}
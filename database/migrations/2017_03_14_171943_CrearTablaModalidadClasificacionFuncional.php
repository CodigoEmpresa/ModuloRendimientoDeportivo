<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaModalidadClasificacionFuncional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad_clasificacion_funcional', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Modalidad_Id')->unsigned();
            $table->integer('Clasificacion_Funcional_Id')->unsigned();
            $table->timestamps();

            $table->foreign('Modalidad_Id')->references('Id')->on('modalidad');
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
        Schema::table('modalidad_clasificacion_funcional', function(Blueprint $table){
            $table->dropForeign('Modalidad_Id');
            $table->dropForeign('Clasificacion_Funcional_Id');            
        });    
        Schema::drop('modalidad_clasificacion_funcional');
    }
}
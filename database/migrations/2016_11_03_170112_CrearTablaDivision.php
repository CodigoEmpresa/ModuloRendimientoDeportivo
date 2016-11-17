<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDivision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Clasificacion_Deportista_Id')->unsigned();
            $table->integer('Agrupacion_Id')->unsigned();
            $table->integer('Deporte_Id')->unsigned();
            $table->integer('Modalidad_Id')->unsigned();
            $table->integer('Rama_Id')->unsigned();
            $table->integer('Categoria_Id')->unsigned();
            $table->integer('Tipo_Evaluacion_Id')->unsigned();
            $table->string('Nombre_Division');
            $table->timestamps();

            $table->foreign('Clasificacion_Deportista_Id')->references('Id')->on('clasificacion_deportista');
            $table->foreign('Agrupacion_Id')->references('Id')->on('agrupacion');
            $table->foreign('Deporte_Id')->references('Id')->on('deporte');
            $table->foreign('Modalidad_Id')->references('Id')->on('modalidad');
            $table->foreign('Rama_Id')->references('Id')->on('rama');
            $table->foreign('Categoria_Id')->references('Id')->on('categoria');
            $table->foreign('Tipo_Evaluacion_Id')->references('Id')->on('tipo_evaluacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('division', function(Blueprint $table){
            $table->dropForeign('Clasificacion_Deportista_Id');
            $table->dropForeign('Agrupacion_Id');
            $table->dropForeign('Deporte_Id');
            $table->dropForeign('Modalidad_Id');
            $table->dropForeign('Rama_Id');
            $table->dropForeign('Categoria_Id');
            $table->dropForeign('Tipo_Evaluacion_Id');
        });    
        Schema::drop('division');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTabla2EntrenamientoNoConformidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('entrenamiento_no_conformidad', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Entrenamiento_Id')->unsigned();            
            $table->integer('Tratamiento_Conformidad_Id')->unsigned();
            $table->date('Fecha');
            $table->string('Numero_Requisito');            
            $table->timestamps();            
            
            $table->foreign('Entrenamiento_Id')->references('Id')->on('entrenamiento');
            $table->foreign('Tratamiento_Conformidad_Id')->references('Id')->on('tratamiento_conformidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrenamiento_no_conformidad', function(Blueprint $table){
            $table->dropForeign('Entrenamiento_Id');
            $table->dropForeign('Tratamiento_Conformidad_Id');
        });    
        Schema::drop('entrenamiento_no_conformidad');
    }
}
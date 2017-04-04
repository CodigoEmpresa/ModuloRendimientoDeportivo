<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPlanEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Deportista_Id')->unsigned();            
            $table->integer('Entrenador_Id')->unsigned();            
            $table->string('Url_Word');
            $table->string('Url_Excel');
            $table->longText('Observacion_Metodologo')->nullable();
            $table->longText('Observacion_Entrenador')->nullable();
            $table->integer('Numero_Plan');
            $table->timestamps();
            
            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Entrenador_Id')->references('Id')->on('entrenador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_entrenamiento', function(Blueprint $table){
            $table->dropForeign('Entrenador_Id');
            $table->dropForeign('Deportista_Id');
        });    
        Schema::drop('plan_entrenamiento');
    }
}
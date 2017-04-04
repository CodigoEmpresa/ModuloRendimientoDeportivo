<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVersionPlanEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('version_plan_entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Plan_Entrenamiento_Id')->unsigned();            
            $table->string('Url_Word');
            $table->string('Url_Excel');
            $table->longText('Observacion_Metodologo')->nullable();
            $table->longText('Observacion_Entrenador')->nullable();
            $table->integer('Numero_Version');
            $table->timestamps();
            
            $table->foreign('Plan_Entrenamiento_Id')->references('Id')->on('plan_entrenamiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('version_plan_entrenamiento', function(Blueprint $table){
            $table->dropForeign('Plan_Entrenamiento_Id');
        });    
        Schema::drop('version_plan_entrenamiento');
    }
}
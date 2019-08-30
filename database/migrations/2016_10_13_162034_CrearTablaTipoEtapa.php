<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTipoEtapa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tipo_etapa', function (Blueprint $table) {
       $table->increments('Id');            
       $table->integer('Clasificacion_Deportista_Id')->unsigned();
       $table->string('Nombre_Tipo_Etapa');
       
       $table->foreign('Clasificacion_Deportista_Id')->references('Id')->on('clasificacion_deportista');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_etapa', function(Blueprint $table){
            $table->dropForeign(['Clasificacion_Deportista_Id']);
        });        
        Schema::drop('tipo_etapa');
    }
}

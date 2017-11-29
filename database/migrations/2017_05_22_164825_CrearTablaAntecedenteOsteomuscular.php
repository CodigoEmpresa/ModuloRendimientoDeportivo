<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAntecedenteOsteomuscular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_inicial_antecedente_osteomuscular', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Historia_Inicial_Id')->unsigned();            
            $table->longText('Descripcion');
            $table->timestamps();
            
            //$table->foreign('Historia_Inicial_Id')->references('Id')->on('historia_inicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historia_inicial_antecedente_osteomuscular', function(Blueprint $table){
            $table->dropForeign('Historia_Inicial_Id');
        });    
        Schema::drop('historia_inicial_antecedente_osteomuscular');
    }
}
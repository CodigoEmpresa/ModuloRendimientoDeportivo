<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaEtapa extends Migration
{
   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapa', function (Blueprint $table) {
            $table->increments('Id');   
            $table->integer('Tipo_Etapa_Id')->unsigned();
            $table->string('Nombre_Etapa');
            $table->string('Estimulo'); 
            $table->timestamps();
            
            $table->foreign('Tipo_Etapa_Id')->references('Id')->on('tipo_etapa');                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etapa', function(Blueprint $table){
            $table->dropForeign(['Tipo_Etapa_Id']);
        });    
        Schema::drop('etapa');
    }
}

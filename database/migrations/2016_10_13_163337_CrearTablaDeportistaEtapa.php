<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaEtapa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deportista_etapa', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Etapa_Id')->unsigned();
            $table->string('Smmlv');
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Etapa_Id')->references('Id')->on('etapa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_etapa', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Etapa_Id');
        });    
        Schema::drop('deportista_etapa');
    }
}
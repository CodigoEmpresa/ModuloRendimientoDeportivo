<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaComplemento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deportista_complemento', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Complemento_Id')->unsigned();
            $table->string('Cantidad');
            $table->string('Valor');
            $table->string('Fecha');
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Complemento_Id')->references('Id')->on('complemento');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_complemento', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Complemento_Id');            
        });    
        Schema::drop('deportista_complemento');
    }
}
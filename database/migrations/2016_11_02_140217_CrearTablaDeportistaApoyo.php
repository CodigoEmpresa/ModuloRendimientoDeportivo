<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaApoyo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('deportista_apoyo', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Apoyo_Id')->unsigned();
            $table->string('Valor');
            $table->date('Fecha');
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Apoyo_Id')->references('Id')->on('apoyo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_apoyo', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Apoyo_Id');            
        });    
        Schema::drop('deportista_apoyo');
    }
}
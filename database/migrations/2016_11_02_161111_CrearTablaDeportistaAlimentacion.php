<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaAlimentacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deportista_alimentacion', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->integer('Alimentacion_Id')->unsigned();
            $table->string('Cantidad');
            $table->string('Valor');
            $table->string('Fecha');
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            $table->foreign('Alimentacion_Id')->references('Id')->on('alimentacion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_alimentacion', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
            $table->dropForeign('Alimentacion_Id');            
        });    
        Schema::drop('deportista_alimentacion');
    }
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportistaTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('deportista_test', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Deportista_Id')->unsigned();
            //$table->integer('Tipo_Test_Id')->unsigned();
            $table->integer('Test_Id')->unsigned();
            $table->integer('Variable_Test_Id')->unsigned();
            //$table->string('Nombre_Test')->nullable();
            $table->string('Resultado');
            $table->longText('Descripcion_Resultado');
            $table->timestamps();            
            
            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
            //$table->foreign('Tipo_Test_Id')->references('Id')->on('tipo_test');
            $table->foreign('Test_Id')->references('Id')->on('test');
            $table->foreign('Variable_Test_Id')->references('Id')->on('variable_test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista_test', function(Blueprint $table){
            $table->dropForeign('Deportista_Id')->references('Id');
            //$table->dropForeign('Tipo_Test_Id')->references('Id');
            $table->dropForeign('Test_Id')->references('Id');
            $table->dropForeign('Variable_Test_Id')->references('Id');
        });
        Schema::drop('deportista_test');
    }
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Tipo_Test_Id')->unsigned();            
            $table->string('Nombre_Test');
            $table->timestamps();            
            
            $table->foreign('Tipo_Test_Id')->references('Id')->on('tipo_test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test', function(Blueprint $table){
            $table->dropForeign('Tipo_Test_Id')->references('Id');
        });
        Schema::drop('test');
    }
}
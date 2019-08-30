<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaComplemento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complemento', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Tipo_Complemento_Id')->unsigned();
            $table->string('Nombre_Complemento');
            $table->string('Valor_Complemento');

            $table->foreign('Tipo_Complemento_Id')->references('Id')->on('tipo_complemento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complemento', function(Blueprint $table){
            $table->dropForeign('Tipo_Complemento_Id');
        });    
        Schema::drop('complemento');
    }
}

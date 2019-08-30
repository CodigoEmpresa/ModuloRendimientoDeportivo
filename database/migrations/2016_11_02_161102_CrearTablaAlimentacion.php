<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAlimentacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentacion', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Tipo_Alimentacion_Id')->unsigned();
            $table->string('Nombre_Alimentacion');
            $table->string('Valor_Alimentacion');

            $table->foreign('Tipo_Alimentacion_Id')->references('Id')->on('tipo_alimentacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alimentacion', function(Blueprint $table){
            $table->dropForeign('Tipo_Alimentacion_Id');
        });    
        Schema::drop('alimentacion');
    }
}

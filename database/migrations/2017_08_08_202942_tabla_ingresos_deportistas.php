<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaIngresosDeportistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->string('Tipo');
            $table->date('Fecha');
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingresos', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
        });
        Schema::drop('ingresos');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPreguntaIdioma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_idioma', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('ValoracionI_Id')->unsigned();
            $table->string('Idioma');
            $table->string('Habla');
            $table->string('Lee');
            $table->string('Escribe');

            $table->foreign('ValoracionI_Id')->references('Id')->on('valoracion_psicosocial');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregunta_idioma', function(Blueprint $table){
            $table->dropForeign('ValoracionI_Id');
        });    
        Schema::drop('pregunta_idioma');
    }
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPreguntaQuien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_quien', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('ValoracionQ_Id')->unsigned();
            $table->string('Quien');
            $table->string('Razon');

            $table->foreign('ValoracionQ_Id')->references('Id')->on('valoracion_psicosocial');

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
        Schema::table('pregunta_quien', function(Blueprint $table){
            $table->dropForeign('ValoracionQ_Id');
        });    
        Schema::drop('pregunta_quien');
    }
}
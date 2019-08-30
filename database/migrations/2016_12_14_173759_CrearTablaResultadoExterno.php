<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaResultadoExterno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('resultado_externo', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('CertamenDivisionResultado_Id')->unsigned();            
            $table->string('Nombres');            
            $table->timestamps();

            $table->foreign('CertamenDivisionResultado_Id')->references('Id')->on('certamen_division_resultado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resultado_externo', function(Blueprint $table){
            $table->dropForeign('CertamenDivisionResultado_Id');
        });    
        Schema::drop('resultado_externo');
    }
}
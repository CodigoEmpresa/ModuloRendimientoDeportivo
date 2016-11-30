<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCertamenPruebaDeportista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certamen_division_deportista', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('CertamenDivision_Id')->unsigned();
            $table->integer('Deportista_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('CertamenDivision_Id')->references('Id')->on('certamen_division');
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
        Schema::table('certamen_division_deportista', function(Blueprint $table){
            $table->dropForeign('CertamenDivision_Id');
            $table->dropForeign('Deportista_Id');            
        });    
        Schema::drop('certamen_division_deportista');
    }
}
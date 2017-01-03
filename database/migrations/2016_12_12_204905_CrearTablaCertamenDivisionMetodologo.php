<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCertamenDivisionMetodologo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certamen_division_metodologo', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('CertamenDivision_Id')->unsigned();
            $table->integer('Persona_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('CertamenDivision_Id')->references('Id')->on('certamen_division');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certamen_division_metodologo', function(Blueprint $table){
            $table->dropForeign('CertamenDivision_Id');         
        });    
        Schema::drop('certamen_division_metodologo');
    }
}
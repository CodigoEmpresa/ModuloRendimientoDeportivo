<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCertamenPrueba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('certamen_division', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Certamen_Id')->unsigned();
            $table->integer('Division_Id')->unsigned();            
            $table->timestamps();

            $table->foreign('Certamen_Id')->references('Id')->on('certamen');
            $table->foreign('Division_Id')->references('Id')->on('division');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certamen_division', function(Blueprint $table){
            $table->dropForeign('Certamen_Id');
            $table->dropForeign('Division_Id');            
        });    
        Schema::drop('certamen_division');
    }
}
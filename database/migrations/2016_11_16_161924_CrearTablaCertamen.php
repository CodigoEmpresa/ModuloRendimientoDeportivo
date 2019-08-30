<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCertamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certamen', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Evento_Id')->unsigned();
            $table->integer('Sede_Id')->unsigned();
            $table->date('Fecha_Inicio');
            $table->date('Fecha_Fin');
            $table->string('Nombre_Certamen');

            
            $table->timestamps();

            $table->foreign('Evento_Id')->references('Id')->on('evento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certamen', function(Blueprint $table){
            $table->dropForeign('Evento_Id');
        });    
        Schema::drop('certamen');
    }
}

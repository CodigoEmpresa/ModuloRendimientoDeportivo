<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCertamenDivisionResultado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certamen_division_resultado', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('CertamenDivision_Id')->unsigned();
            $table->integer('Departamento_Id');            
            $table->integer('Deportista_Id')->nullable();            
            $table->string('Marca');            
            $table->string('Puesto');            
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
        Schema::drop('certamen_division_resultado');
    }
}
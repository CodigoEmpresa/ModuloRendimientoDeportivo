<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVPsicosocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('valoracion_psicosocial', function (Blueprint $table) {

            $table->increments('Id');            
            $table->integer('Deportista_Id')->unsigned();       

            $table->string('Discapacidad');
            $table->string('EdadInicio');
            $table->string('AniosPractica');
            $table->string('DesplazamientoPreg');
            $table->string('Desplazamiento')->nullable();

            $table->string('P1');
            $table->string('P2');
            $table->string('P3');
            $table->string('P5');
            $table->string('P6');

            $table->string('P8');
            $table->string('P81');
            $table->string('P82');

            $table->string('P9');
            $table->string('P10');

            $table->string('P11')->nullable();
            $table->string('P111')->nullable();
            $table->string('P112')->nullable();
            $table->string('P113')->nullable();
            $table->string('P114')->nullable();

            $table->string('P13')->nullable();
            $table->string('P15')->nullable();
            $table->string('P16')->nullable();
            $table->string('P17')->nullable();

            $table->string('P19')->nullable();
            $table->string('P191')->nullable();
            $table->string('P192')->nullable();
            $table->string('P193')->nullable();
            $table->string('P194')->nullable();
            $table->string('P195')->nullable();
            $table->string('P196')->nullable();

            $table->string('P20');
            $table->string('P21');
            $table->string('P22');
            $table->string('P23');
            $table->string('P24');
            $table->string('P25')->nullable();
            $table->string('P27');
            $table->string('P29');
            $table->string('P34');
            $table->string('P35');
            $table->string('P40');            
            $table->string('P42');
            $table->string('P43');
            $table->string('P44');            
            $table->string('P46');
            $table->string('P49');
            $table->string('P51');            
            $table->string('ConceptoProfesional');//Cambiado a TEXT

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');

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
        Schema::table('valoracion_psicosocial', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
        });    
        Schema::drop('valoracion_psicosocial');
    }
}
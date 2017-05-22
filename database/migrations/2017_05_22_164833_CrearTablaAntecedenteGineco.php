<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAntecedenteGineco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_inicial_antecedente_gineco', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Historia_Inicial_Id')->unsigned();
            $table->string('Menarquia');
            $table->string('Ciclo');
            $table->string('Regular');
            $table->string('Dismenorrea');
            $table->string('Fum');
            $table->string('Fup');
            $table->string('G');
            $table->string('P');
            $table->string('V');
            $table->string('A');
            $table->string('Amenorrea');
            $table->string('Planifica_Preg');
            $table->string('Metodo_Planificacion');
            $table->timestamps();
            
            $table->foreign('Historia_Inicial_Id')->references('Id')->on('historia_inicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historia_inicial_antecedente_gineco', function(Blueprint $table){
            $table->dropForeign('Historia_Inicial_Id');
        });    
        Schema::drop('historia_inicial_antecedente_gineco');
    }
}
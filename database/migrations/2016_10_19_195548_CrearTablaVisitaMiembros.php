<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVisitaMiembros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visita_miembro', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('VisitaM_Id')->unsigned();
            $table->string('Nombre_Miembro');            
            $table->string('Parentesco_Miembro');            
            $table->string('Regimen_Subsidiado');            
            $table->string('Regimen_Contributivo');
            $table->string('Numero_Afiliados');            
            $table->string('Enfermedades');            
            $table->string('Discapacidades');            

            $table->foreign('VisitaM_Id')->references('Id')->on('visita_domiciliaria');

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
        Schema::table('visita_miembro', function(Blueprint $table){
            $table->dropForeign('VisitaM_Id');
        });    
        Schema::drop('visita_miembro');
    }
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArregloParalimpico2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //Arreglos a la tabla MODALIDAD_CLASIFICACION_FUNCIONAL
        Schema::table('modalidad_clasificacion_funcional', function(Blueprint $table){       
            

            $table->foreign('Modalidad_Id')->references('Id')->on('modalidad');
            $table->foreign('Clasificacion_Funcional_Id')->references('Id')->on('clasificacion_funcional');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modalidad_clasificacion_funcional', function(Blueprint $table){
            $table->dropForeign('Modalidad_Id');
            $table->dropForeign('Clasificacion_Funcional_Id');            
        });    
        Schema::drop('modalidad_clasificacion_funcional');
    }
}
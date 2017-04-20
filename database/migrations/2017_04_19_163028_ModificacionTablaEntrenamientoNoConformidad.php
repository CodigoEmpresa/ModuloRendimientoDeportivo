<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificacionTablaEntrenamientoNoConformidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrenamiento_no_conformidad', function(Blueprint $table){       

            $table->longText('Descripcion_No_Conformidad');
            $table->longText('Descripcion_Accion');
            $table->string('Inconvenientes');
        });        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

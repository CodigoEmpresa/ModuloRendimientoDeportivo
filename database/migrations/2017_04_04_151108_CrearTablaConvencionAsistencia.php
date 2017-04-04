<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConvencionAsistencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convencion_asistencia', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Nombre_Convencion_asistencia'); 
            $table->string('Abreviatura'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('convencion_asistencia');
    }
}

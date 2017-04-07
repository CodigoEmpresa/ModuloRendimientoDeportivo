<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTabla2AsistenciaEntrenamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('asistencia_entrenamiento', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Deportista_Entrenamiento_Id')->unsigned();            
            $table->date('Fecha');
            $table->integer('Numero_Dia');
            $table->integer('Convencion_Asistencia_Id')->unsigned();
            $table->integer('Verificacion_Convencion_1_Id')->unsigned();
            $table->integer('Verificacion_Convencion_2_Id')->unsigned();
            $table->integer('Verificacion_Convencion_3_Id')->unsigned();
            $table->string('Url_Soporte_Medico')->nullable();            
            $table->string('Url_Soporte_Calamidad')->nullable();            
            $table->timestamps();            
            
            $table->foreign('Deportista_Entrenamiento_Id')->references('Id')->on('deportista_entrenamiento');
            $table->foreign('Convencion_Asistencia_Id')->references('Id')->on('convencion_asistencia');
            $table->foreign('Verificacion_Convencion_1_Id')->references('Id')->on('convencion_asistencia');
            $table->foreign('Verificacion_Convencion_2_Id')->references('Id')->on('convencion_asistencia');
            $table->foreign('Verificacion_Convencion_3_Id')->references('Id')->on('convencion_asistencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistencia_entrenamiento', function(Blueprint $table){
            $table->dropForeign('Deportista_Entrenamiento_Id')->references('Id');
            $table->dropForeign('Convencion_Asistencia_Id')->references('Id');
            $table->dropForeign('Verificacion_Convencion_1_Id')->references('Id');
            $table->dropForeign('Verificacion_Convencion_2_Id')->references('Id');
            $table->dropForeign('Verificacion_Convencion_3_Id')->references('Id');
        });    
        Schema::drop('asistencia_entrenamiento');
    }
}
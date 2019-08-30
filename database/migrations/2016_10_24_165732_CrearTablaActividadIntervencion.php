<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActividadIntervencion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_intervencion', function (Blueprint $table) {
            $table->increments('Id');   
            $table->integer('Tipo_Actividad_Id')->unsigned();
            $table->string('Otro_Actividad')->nullable();
            $table->string('Descripcion'); 
            $table->string('DeportistaP'); 
            $table->string('DeportistaA')->nullable(); 
            $table->string('MultidisciplinarioP'); 
            $table->string('MultidisciplinarioA')->nullable(); 
            $table->string('EntrenadorP'); 
            $table->string('EntrenadorA')->nullable(); 
            $table->string('ComisionadoP'); 
            $table->string('ComisionadoA')->nullable(); 
            $table->string('Otros')->nullable(); 
            $table->string('OtrosP')->nullable(); 
            $table->string('OtrosA')->nullable(); 
            $table->string('Fecha_Programada'); 
            $table->string('Fecha_Realizacion')->nullable();
            $table->string('Reprogramacion')->nullable(); 
            $table->string('Total_Asistentes')->nullable(); 
            $table->string('Observaciones')->nullable(); 
            $table->string('Total_Evaluadores')->nullable(); 
            $table->string('Nombre_Gestor')->nullable(); 
            $table->string('Nombre_Coordinador')->nullable(); 
            $table->string('Anexo1_Url')->nullable(); 
            $table->string('Anexo2_Url')->nullable(); 
            $table->string('Anexo3_Url')->nullable(); 
            $table->string('Anexo4_Url')->nullable(); 
            $table->timestamps();
            
            $table->foreign('Tipo_Actividad_Id')->references('Id')->on('tipo_actividad');                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actividad_intervencion', function(Blueprint $table){
            $table->dropForeign(['Tipo_Actividad_Id']);
        });    
        Schema::drop('actividad_intervencion');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaExamenFisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_inicial_examen_fisico', function (Blueprint $table) {
            $table->increments('Id');            
            $table->integer('Historia_Inicial_Id')->unsigned();
            /*************************************************/
            $table->string('Pa_Pie_Dato');
            $table->string('Pa_Pie_Observacion');
            $table->string('Pa_Supino_Dato');
            $table->string('Pa_Supino_Observacion');
            $table->string('Fc_Reposo_Dato');
            $table->string('Fc_Reposo_Observacion');
            $table->string('Fr_Dato');
            $table->string('Fr_Observacion');
            $table->string('Temperatura_Dato');
            $table->string('Temperatura_Observacion');
            $table->string('Peso_Dato');
            $table->string('Peso_Observacion');
            $table->string('Estatura_Dato');
            $table->string('Estatura_Observacion');
            /*************************************************/
            $table->string('Cabeza_Dato');
            $table->string('Cabeza_Observacion');
            $table->string('Cuello_Dato');
            $table->string('Cuello_Observacion');
            $table->string('Agudeza_Visual_Dato');
            $table->string('Agudeza_Visual_Observacion');
            $table->string('Od');
            $table->string('Oi');
            $table->string('F_De_O');
            $table->string('Audicion_Dato');
            $table->string('Audicion_Observacion');
            $table->string('Orl_Dato');
            $table->string('Orl_Observacion');
            $table->string('Cavidad_Oral_Dato');
            $table->string('Cavidad_Oral_Observacion');
            $table->string('Pulmonar_Dato');
            $table->string('Pulmonar_Observacion');
            $table->string('Cardiaco_Dato');
            $table->string('Cardiaco_Observacion');
            $table->string('Vascular_Periferico_Dato');
            $table->string('Vascular_Periferico_Observacion');
            $table->string('Abdomen_Dato');
            $table->string('Abdomen_Observacion');
            $table->string('Genitourinario_Dato');
            $table->string('Genitourinario_Observacion');
            $table->string('Neurologico_Dato');
            $table->string('Neurologico_Observacion');
            $table->string('Piel_Faneras_Dato');
            $table->string('Piel_Faneras_Observacion');
            /*************************************************/
            $table->string('Postura_Ap_Dato');
            $table->string('Postura_Ap_Observacion');
            $table->string('Postura_Pa_Dato');
            $table->string('Postura_Pa_Observacion');
            $table->string('Postura_Lateral_Dato');
            $table->string('Postura_Lateral_Observacion');
            $table->string('Postura_Cuello_Dato');
            $table->string('Postura_Cuello_Observacion');
            $table->string('Ms_Hombro_Dato');
            $table->string('Ms_Hombro_Observacion');
            $table->string('Ms_Codo_Dato');
            $table->string('Ms_Codo_Observacion');
            $table->string('Ms_Muneca_Dato');
            $table->string('Ms_Muneca_Observacion');
            $table->string('Ms_Mano_Dato');
            $table->string('Ms_Mano_Observacion');
            $table->string('Columna_Cervical_Dato');
            $table->string('Columna_Cervical_Observacion');
            $table->string('Columna_Dorsal_Dato');
            $table->string('Columna_Dorsal_Observacion');
            $table->string('Columna_Lumbosaca_Dato');
            $table->string('Columna_Lumbosaca_Observacion');
            $table->string('Mi_Cadera_Dato');
            $table->string('Mi_Cadera_Observacion');
            $table->string('Mi_Rodilla_Dato');
            $table->string('Mi_Rodilla_Observacion');
            $table->string('Mi_Tobillo_Dato');
            $table->string('Mi_Tobillo_Observacion');

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
        Schema::table('historia_inicial_examen_fisico', function(Blueprint $table){
            $table->dropForeign('Historia_Inicial_Id');
        });    
        Schema::drop('historia_inicial_examen_fisico');
    }
}
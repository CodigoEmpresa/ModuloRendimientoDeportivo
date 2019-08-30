<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVisitaDomiciliaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('visita_domiciliaria', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Deportista_Id')->unsigned();
            $table->date('Fecha_Intervencion');   
            $table->string('Nombres_Receptor');         
            $table->string('Apellidos_Receptor');
            $table->string('Documento_Receptor');
            $table->string('Vivienda');
            $table->string('Area_Vivienda');         
            $table->string('Tipo_Vivienda');         
            $table->string('Tipo_Vivienda_Propia')->nullable();
            $table->string('Tiempo_Vivienda');
            $table->string('Total_Habitaciones');         
            $table->string('Total_Banos');
            $table->string('Total_Cocinas');
            $table->string('Total_Salas');
            $table->string('Total_Comedores');         
            $table->string('Total_Ropas');
            $table->string('Otros_Distribucion');
            $table->string('Total_Camas');
            $table->string('Total_Closets');         
            $table->string('Total_Televisores');
            $table->string('Total_Neveras');
            $table->string('Total_Estufas');
            $table->string('Otros_Muebles');         
            $table->string('Aseo');
            $table->string('Organizacion');
            $table->string('Iluminacion');
            $table->string('Ventilacion');
            $table->string('Condiciones_Vivienda');
            $table->string('Tipo_Ingreso')->nullable();         
            $table->string('Otro_Ingreso')->nullable;
            $table->string('Total_Ingreso')->nullable();
            $table->string('Egreso_Alimentacion')->nullable();
            $table->string('Egreso_Arriendo')->nullable();
            $table->string('Egreso_Educacion')->nullable();
            $table->string('Egreso_Cuota_Vivienda')->nullable();
            $table->string('Egreso_Salud')->nullable();
            $table->string('Egreso_Recreacion')->nullable();
            $table->string('Egreso_Servicios')->nullable();
            $table->string('Egreso_Transporte')->nullable();
            $table->string('Deudas')->nullable();
            $table->string('Deudas_Quien')->nullable();
            $table->string('Total_Egresos')->nullable();
            $table->string('Total_Deudas')->nullable();
            $table->string('Situacion_Economica')->nullable();
            $table->string('Practicas_Deportivas');         
            $table->string('Juegos_Familiares');
            $table->string('Salidas_Publicas');
            $table->string('Quehaceres');
            $table->string('Actividad_Libre');
            $table->string('Actividad_Academica');
            $table->string('Television');         
            $table->string('Internet');
            $table->string('P16');
            $table->string('P17');
            $table->string('P18');
            $table->string('P19');
            $table->string('P20');
            $table->string('P21');
            $table->string('Concepto_Profesional');
            $table->string('Genograma_Url');            
            $table->string('Genograma_Observacion');
            $table->string('Imagen1_Url');
            $table->string('Imagen2_Url');
            $table->string('Imagen3_Url');
            $table->string('Imagen4_Url');
            $table->string('Imagen5_Url')->nullable();
            $table->string('Imagen6_Url')->nullable();            
            $table->timestamps();

            $table->foreign('Deportista_Id')->references('Id')->on('deportista');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visita_domiciliaria', function(Blueprint $table){
            $table->dropForeign('Deportista_Id');
        });    
        Schema::drop('visita_domiciliaria');
    }
}
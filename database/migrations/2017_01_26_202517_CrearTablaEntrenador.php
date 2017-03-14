<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEntrenador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('entrenador', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('Persona_Id')->unsigned();
            $table->integer('Clasificacion_Deportista_Id')->unsigned();            
            $table->integer('Agrupacion_Id')->unsigned();            
            $table->integer('Deporte_Id')->unsigned();            
            $table->integer('Modalidad_Id')->unsigned();            
            $table->integer('Lugar_Expedicion_Id')->unsigned();
            $table->date('Fecha_Expedicion');
            $table->string('Numero_Pasaporte')->nullable();
            $table->date('Fecha_Pasaporte')->nullable();
            $table->integer('Departamento_Id_Nac')->unsigned();  
            $table->integer('Libreta_Preg');
            $table->string('Numero_Libreta_Mil')->nullable();
            $table->string('Distrito_Libreta_Mil')->nullable();          
            $table->integer('Parentesco_Id')->unsigned();
            $table->string('Nombre_Contacto');            
            $table->string('Fijo_Contacto');
            $table->string('Celular_Contacto');     
            $table->integer('Departamento_Id_Localiza')->unsigned();
            $table->integer('Ciudad_Id_Localiza')->unsigned();
            $table->string('Direccion_Localiza');
            $table->string('Barrio_Localiza');
            $table->integer('Localidad_Id_Localiza')->unsigned();         
            $table->string('Fijo_Localiza');
            $table->string('Celular_Localiza');
            $table->string('Correo_Electronico');    
            $table->integer('Regimen_Salud_Id')->unsigned();
            $table->date('Fecha_Afiliacion')->nullable();            
            $table->integer('Tipo_Afiliacion_Id')->unsigned();
            $table->integer('Medicina_Prepago');            
            $table->string('Nombre_MedicinaPrepago'); 
            $table->integer('Eps_Id')->unsigned()->nullable();
            $table->integer('Nivel_Regimen_Sub_Id')->unsigned()->nullable();            
            $table->integer('Riesgo_Laboral');                       
            $table->integer('Arl_Id')->unsigned()->nullable(); 
            $table->integer('Fondo_PensionPreg_Id')->unsigned(); 
            $table->integer('Fondo_Pension_Id')->unsigned()->nullable();   
            $table->integer('Profesional_Preg');
            $table->string('Titulo_Pregrado');                   
            $table->string('Titulo_Especializacion');
            $table->string('Titulo_Maestria');
            $table->string('Titulo_Doctorado');
            $table->string('Curso_Entrenadores');
            $table->integer('Grupo_Sanguineo_Id')->unsigned();
            $table->integer('Uso_Medicamento');
            $table->string('Medicamento')->nullable();
            $table->string('Tiempo_Medicamento')->nullable();
            $table->integer('Otro_Medico_Preg');
            $table->string('Otro_Medico')->nullable();
            $table->integer('Sudadera_Talla_Id')->unsigned();
            $table->integer('Camiseta_Talla_Id')->unsigned();
            $table->integer('Pantaloneta_Talla_Id')->unsigned();
            $table->integer('Tenis_Talla_Id')->unsigned();               

            $table->string('Imagen_Url')->nullable();
            $table->string('Archivo1_Url');      

            $table->foreign('Clasificacion_Deportista_Id')->references('Id')->on('clasificacion_deportista');
            $table->foreign('Agrupacion_Id')->references('Id')->on('agrupacion');
            $table->foreign('Deporte_Id')->references('Id')->on('deporte');
            $table->foreign('Modalidad_Id')->references('Id')->on('modalidad');
            $table->foreign('Parentesco_Id')->references('Id')->on('parentesco');            
            $table->foreign('Regimen_Salud_Id')->references('Id')->on('regimen_salud');
            $table->foreign('Tipo_Afiliacion_Id')->references('Id')->on('tipo_afiliacion');            
            $table->foreign('Sudadera_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Camiseta_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Pantaloneta_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Tenis_Talla_Id')->references('Id')->on('talla');       
            $table->foreign('Fondo_PensionPreg_Id')->references('Id')->on('fondo_pension');     

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
        Schema::table('entrenador', function(Blueprint $table){
            $table->dropForeign('Clasificacion_Deportista_Id');
            $table->dropForeign('Agrupacion_Id');
            $table->dropForeign('Deporte_Id');
            $table->dropForeign('Modalidad_Id');
            $table->dropForeign('Parentesco_Id');            
            $table->dropForeign('Regimen_Salud_Id');
            $table->dropForeign('Tipo_Afiliacion_Id');
            $table->dropForeign('Sudadera_Talla_Id');
            $table->dropForeign('Camiseta_Talla_Id');
            $table->dropForeign('Pantaloneta_Talla_Id');
            $table->dropForeign('Tenis_Talla_Id');            
            $table->dropForeign('Fondo_Pension_Id');
        });        
        Schema::drop('entrenador');
    }
}
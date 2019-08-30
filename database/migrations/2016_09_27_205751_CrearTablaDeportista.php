<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDeportista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('deportista', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('Persona_Id')->unsigned();
            $table->integer('Pertenece');
            $table->integer('Lugar_Expedicion_Id')->unsigned();
            $table->integer('Clasificacion_Deportista_Id')->unsigned();
            $table->integer('Parentesco_Id')->unsigned();
            $table->integer('Departamento_Id_Localiza')->unsigned();
            $table->integer('Ciudad_Id_Localiza')->unsigned();
            $table->integer('Localidad_Id_Localiza')->unsigned();             
            $table->integer('Estado_Civil_Id')->unsigned();
            $table->integer('Estrato_Id')->unsigned();            
            $table->integer('Regimen_Salud_Id')->unsigned();
            $table->integer('Tipo_Afiliacion_Id')->unsigned();
            $table->integer('Nivel_Regimen_Sub_Id')->unsigned()->nullable();
            $table->integer('Eps_Id')->unsigned()->nullable();
            $table->integer('Sudadera_Talla_Id')->unsigned();
            $table->integer('Camiseta_Talla_Id')->unsigned();
            $table->integer('Pantaloneta_Talla_Id')->unsigned();
            $table->integer('Tenis_Talla_Id')->unsigned();      
            $table->integer('Grupo_Sanguineo_Id')->unsigned();
            $table->integer('Tipo_Cuenta_Id')->unsigned();
            $table->integer('Banco_Id')->unsigned(); 
            $table->integer('Arl_Id')->unsigned()->nullable(); 
            $table->integer('Fondo_PensionPreg_Id')->unsigned(); 
            $table->integer('Fondo_Pension_Id')->unsigned()->nullable(); 

            $table->integer('Departamento_Id_Nac')->unsigned();
            
            $table->date('Fecha_Expedicion');
            $table->string('Numero_Pasaporte')->nullable();
            $table->date('Fecha_Pasaporte')->nullable();
            $table->integer('Libreta_Preg');
            $table->string('Numero_Libreta_Mil')->nullable();
            $table->string('Distrito_Libreta_Mil')->nullable();
            $table->string('Nombre_Contacto');            
            $table->string('Fijo_Contacto');
            $table->string('Celular_Contacto');     
            $table->string('Barrio_Localiza');
            $table->string('Direccion_Localiza');
            $table->string('Fijo_Localiza');
            $table->string('Celular_Localiza');
            $table->string('Correo_Electronico');
            $table->integer('Numero_Hijos');
            $table->string('Numero_Cuenta');       
            $table->date('Fecha_Afiliacion')->nullable();            
            $table->integer('Medicina_Prepago');            
            $table->string('Nombre_MedicinaPrepago');            
            $table->integer('Riesgo_Laboral');                       
            $table->integer('Uso_Medicamento');
            $table->string('Medicamento')->nullable();
            $table->string('Tiempo_Medicamento')->nullable();
            $table->integer('Otro_Medico_Preg');
            $table->string('Otro_Medico')->nullable();
            $table->integer('Resolucion_Vigente')->nullable();
            $table->integer('Deber_Obligacion')->nullable();            
            $table->string('Imagen_Url')->nullable();
            $table->string('Archivo1_Url');

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
        Schema::drop('deportista');
    }
}
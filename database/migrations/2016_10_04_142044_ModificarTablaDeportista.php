<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaDeportista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('deportista', function(Blueprint $table){                 
            $table->foreign('Clasificacion_Deportista_Id')->references('Id')->on('clasificacion_deportista');
            $table->foreign('Parentesco_Id')->references('Id')->on('parentesco');
            $table->foreign('Estado_Civil_Id')->references('Id')->on('estado_civil');
            $table->foreign('Estrato_Id')->references('Id')->on('estrato');
            $table->foreign('Regimen_Salud_Id')->references('Id')->on('regimen_salud');
            $table->foreign('Tipo_Afiliacion_Id')->references('Id')->on('tipo_afiliacion');
            //$table->foreign('Nivel_Regimen_Sub_Id')->references('Id')->on('nivel_regimen_sub');
            $table->foreign('Sudadera_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Camiseta_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Pantaloneta_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Tenis_Talla_Id')->references('Id')->on('talla');
            $table->foreign('Tipo_Cuenta_Id')->references('Id')->on('tipo_cuenta');
            $table->foreign('Banco_Id')->references('Id')->on('banco');
       //     $table->foreign('Arl_Id')->references('Id')->on('arl');            
            $table->foreign('Fondo_PensionPreg_Id')->references('Id')->on('fondo_pension');
        });        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deportista', function(Blueprint $table){
            $table->dropForeign('Clasificacion_Deportista_Id');
            $table->dropForeign('Parentesco_Id');
            $table->dropForeign('Estado_Civil_Id');
            $table->dropForeign('Estrato_Id');
            $table->dropForeign('Regimen_Salud_Id');
            $table->dropForeign('Tipo_Afiliacion_Id');
            //$table->dropForeign('Nivel_Regimen_Sub_Id');
            $table->dropForeign('Sudadera_Talla_Id');
            $table->dropForeign('Camiseta_Talla_Id');
            $table->dropForeign('Pantaloneta_Talla_Id');
            $table->dropForeign('Tenis_Talla_Id');
            $table->dropForeign('Tipo_Cuenta_Id');
            $table->dropForeign('Banco_Id');
       //     $table->dropForeign('Arl_Id');
            $table->dropForeign('Fondo_Pension_Id');
        });        
    }
}

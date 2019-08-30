<?php

use Illuminate\Database\Seeder;

class TipoEvaluacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_evaluacion')->delete();        
        DB::table('tipo_evaluacion')->insert([
            ['Nombre_Tipo_Evaluacion' => 'Peso'],            
            ['Nombre_Tipo_Evaluacion' => 'Tiempo'],
            ['Nombre_Tipo_Evaluacion' => 'Otro'],            
        ]);        
    }
}

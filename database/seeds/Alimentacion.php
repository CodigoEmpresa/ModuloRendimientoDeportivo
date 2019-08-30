<?php

use Illuminate\Database\Seeder;

class Alimentacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alimentacion')->delete();        
        DB::table('alimentacion')->insert([            
            ['Tipo_Alimentacion_Id' => '1', 'Nombre_Alimentacion' => 'Desayuno', 'Valor_Alimentacion' => '11693'],
            ['Tipo_Alimentacion_Id' => '1', 'Nombre_Alimentacion' => 'Almuerzo', 'Valor_Alimentacion' => '16549'],
            ['Tipo_Alimentacion_Id' => '1', 'Nombre_Alimentacion' => 'Refrigerio', 'Valor_Alimentacion' => '9744'],
            ['Tipo_Alimentacion_Id' => '2', 'Nombre_Alimentacion' => 'Desayuno', 'Valor_Alimentacion' => '10718'],
            ['Tipo_Alimentacion_Id' => '2', 'Nombre_Alimentacion' => 'Almuerzo', 'Valor_Alimentacion' => '14954'],
            ['Tipo_Alimentacion_Id' => '2', 'Nombre_Alimentacion' => 'Refrigerio', 'Valor_Alimentacion' => '9048'],
            ['Tipo_Alimentacion_Id' => '3', 'Nombre_Alimentacion' => 'Desayuno', 'Valor_Alimentacion' => '10265'],
            ['Tipo_Alimentacion_Id' => '3', 'Nombre_Alimentacion' => 'Almuerzo', 'Valor_Alimentacion' => '14259'],
            ['Tipo_Alimentacion_Id' => '3', 'Nombre_Alimentacion' => 'Refrigerio', 'Valor_Alimentacion' => '8700'],
        ]);
    }
}

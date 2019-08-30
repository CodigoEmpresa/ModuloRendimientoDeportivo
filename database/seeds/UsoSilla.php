<?php

use Illuminate\Database\Seeder;

class UsoSilla extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uso_silla')->delete();        
        DB::table('uso_silla')->insert([            
            ['Nombre_Uso_Silla' => 'Caminante con muleta'],
            ['Nombre_Uso_Silla' => 'Caminante con bastón'],
            ['Nombre_Uso_Silla' => 'Competencia'],
            ['Nombre_Uso_Silla' => 'Permanente'],
            ['Nombre_Uso_Silla' => 'Otros'],
        ]);
    }
}

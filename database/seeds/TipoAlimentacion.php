<?php

use Illuminate\Database\Seeder;

class TipoAlimentacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_alimentacion')->delete();        
        DB::table('tipo_alimentacion')->insert([
            ['Nombre_Tipo_Alimentacion' => 'Dieta A'],
            ['Nombre_Tipo_Alimentacion' => 'Dieta B'],
            ['Nombre_Tipo_Alimentacion' => 'Dieta C'],
        ]);
    }
}

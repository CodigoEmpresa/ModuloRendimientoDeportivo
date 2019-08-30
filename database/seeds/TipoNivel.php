<?php

use Illuminate\Database\Seeder;

class TipoNivel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_nivel')->delete();        
        DB::table('tipo_nivel')->insert([
            ['Nombre_Tipo_Nivel' => 'Nacional'],            
            ['Nombre_Tipo_Nivel' => 'Internacional'],
            ['Nombre_Tipo_Nivel' => 'Distrital'],
            ['Nombre_Tipo_Nivel' => 'Regional'],
        ]);   
    }
}

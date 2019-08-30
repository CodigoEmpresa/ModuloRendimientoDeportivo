<?php

use Illuminate\Database\Seeder;

class Apoyo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apoyo')->delete();        
        DB::table('apoyo')->insert([
            ['Nombre_Apoyo' => 'Educación'],
            ['Nombre_Apoyo' => 'Estímulo por resultados'],
            ['Nombre_Apoyo' => 'Monitorias'],
            ['Nombre_Apoyo' => 'Vivienda'],            
            ]);
    }
}

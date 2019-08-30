<?php

use Illuminate\Database\Seeder;

class TipoTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_test')->delete();        
        DB::table('tipo_test')->insert([
            ['Nombre_Tipo_Test' => 'Físico'],
            ['Nombre_Tipo_Test' => 'Técnico'],
            ['Nombre_Tipo_Test' => 'Táctico'],
            ['Nombre_Tipo_Test' => 'Otro'],
        ]);
    }
}

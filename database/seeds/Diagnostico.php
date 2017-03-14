<?php

use Illuminate\Database\Seeder;

class Diagnostico extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnostico')->delete();        
        DB::table('diagnostico')->insert([
            ['Nombre_Diagnostico' => 'Adquirido'],
            ['Nombre_Diagnostico' => 'Congénito'],
            ['Nombre_Diagnostico' => 'Genético'],
        ]);
    }
}

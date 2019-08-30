<?php

use Illuminate\Database\Seeder;

class Discapacidad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discapacidad')->delete();        
        DB::table('discapacidad')->insert([
            ['Nombre_Discapacidad' => 'Auditivo'],
            ['Nombre_Discapacidad' => 'Cognitivo'],
            ['Nombre_Discapacidad' => 'Físico'],
            ['Nombre_Discapacidad' => 'Parálisis cerebral'],
            ['Nombre_Discapacidad' => 'Visual'],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class Horario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horario')->delete();        
        DB::table('horario')->insert([                        
            ['Nombre_Horario' => 'AM'],
            ['Nombre_Horario' => 'PM'],
             ]);
    }
}

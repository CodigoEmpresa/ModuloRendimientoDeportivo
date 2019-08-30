<?php

use Illuminate\Database\Seeder;

class Dominancia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dominancia')->delete();        
        DB::table('dominancia')->insert([            
            ['Nombre_Dominancia' => 'Diestro'],
            ['Nombre_Dominancia' => 'Zurdo'],
            ['Nombre_Dominancia' => 'Ambidiestro'],
        ]);
    }
}
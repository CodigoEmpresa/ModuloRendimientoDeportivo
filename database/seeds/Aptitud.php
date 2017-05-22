<?php

use Illuminate\Database\Seeder;

class Aptitud extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aptitud')->delete();        
        DB::table('aptitud')->insert([
            ['Nombre_Aptitud' => 'Apto'],
            ['Nombre_Aptitud' => 'No apto'],
            ['Nombre_Aptitud' => 'Apto con limitación'],
            ['Nombre_Aptitud' => 'Apto con recomendación'],            
            ]);
    }
}

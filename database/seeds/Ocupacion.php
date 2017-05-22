<?php

use Illuminate\Database\Seeder;

class Ocupacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ocupacion')->delete();        
        DB::table('ocupacion')->insert([            
            ['Nombre_Ocupacion' => 'Empleado'],
            ['Nombre_Ocupacion' => 'Empleador'],
            ['Nombre_Ocupacion' => 'Independiente'],
            ['Nombre_Ocupacion' => 'Estudiante'],            
        ]);
    }
}
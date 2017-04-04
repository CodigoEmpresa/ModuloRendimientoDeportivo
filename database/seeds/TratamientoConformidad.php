<?php

use Illuminate\Database\Seeder;

class TratamientoConformidad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tratamiento_conformidad')->delete();        
        DB::table('tratamiento_conformidad')->insert([                        
            ['Nombre_Tratamiento_Conformidad' => 'Reproceso'],
            ['Nombre_Tratamiento_Conformidad' => 'Concesión'],
            ['Nombre_Tratamiento_Conformidad' => 'Identificación de no uso'],
             ]);
    }
}

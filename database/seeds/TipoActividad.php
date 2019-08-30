<?php

use Illuminate\Database\Seeder;

class TipoActividad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tipo_actividad')->delete();        
        DB::table('tipo_actividad')->insert([
            ['Nombre_TipoActividad' => 'Cultural'],
            ['Nombre_TipoActividad' => 'Académico no formal'],
            ['Nombre_TipoActividad' => 'Recreativa'],
            ['Nombre_TipoActividad' => 'Otro'],
        ]);
    }
}

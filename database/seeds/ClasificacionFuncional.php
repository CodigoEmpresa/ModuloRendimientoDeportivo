<?php

use Illuminate\Database\Seeder;

class ClasificacionFuncional extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clasificacion_funcional')->delete();        
        DB::table('clasificacion_funcional')->insert([
            ['Nombre_Clasificacion_Funcional' => 'EJM 1'],
            ['Nombre_Clasificacion_Funcional' => 'EJM 2'],
            ['Nombre_Clasificacion_Funcional' => 'EJM 3'],
        ]);
    }
}
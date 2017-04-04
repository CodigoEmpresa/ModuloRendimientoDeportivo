<?php

use Illuminate\Database\Seeder;

class ConvencionAsistencia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('convencion_asistencia')->delete();        
        DB::table('convencion_asistencia')->insert([                        
            ['Nombre_Convencion_Asistencia' => 'Una sesión/día', 'Abreviatura' => '1'],
            ['Nombre_Convencion_Asistencia' => 'Dos sesiones/día', 'Abreviatura' => '2'],
            ['Nombre_Convencion_Asistencia' => 'Falla', 'Abreviatura' => 'F'],
            ['Nombre_Convencion_Asistencia' => 'Médica', 'Abreviatura' => 'M'],
            ['Nombre_Convencion_Asistencia' => 'Calamidad Domestica', 'Abreviatura' => 'K'],
            ['Nombre_Convencion_Asistencia' => 'Competencia', 'Abreviatura' => 'CM'],
            ['Nombre_Convencion_Asistencia' => 'No Programado', 'Abreviatura' => 'NP'],
             ]);
    }
}


<?php

use Illuminate\Database\Seeder;

class TipoEtapa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_etapa')->delete();        
        DB::table('tipo_etapa')->insert([
            ['Nombre_Tipo_Etapa' => 'Nacional', 'Clasificacion_Deportista_Id' => 1],//Convencional
            ['Nombre_Tipo_Etapa' => 'Internacional', 'Clasificacion_Deportista_Id' => 1],//Convencional
            ['Nombre_Tipo_Etapa' => 'Nacional', 'Clasificacion_Deportista_Id' => 2],//Paralimpico
            ['Nombre_Tipo_Etapa' => 'Internacional', 'Clasificacion_Deportista_Id' => 2],//Paralimipico
        ]);
    }
}

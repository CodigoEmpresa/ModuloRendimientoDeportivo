<?php

use Illuminate\Database\Seeder;

class NivelEstudio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivel_estudio')->delete();        
        DB::table('nivel_estudio')->insert([
            ['Nivel_Estudio' => 'Primaria'],
            ['Nivel_Estudio' => 'Bachiller'],
            ['Nivel_Estudio' => 'Técnico'],
            ['Nivel_Estudio' => 'Tecnólogo'],
            ['Nivel_Estudio' => 'Profesional'],
            ['Nivel_Estudio' => 'Diplomado'],
            ['Nivel_Estudio' => 'Especializado'],
            ['Nivel_Estudio' => 'Maestria'],
            ['Nivel_Estudio' => 'Doctorado'],
        ]);
    }
}
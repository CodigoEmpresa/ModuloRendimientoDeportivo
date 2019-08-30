<?php

use Illuminate\Database\Seeder;

class TipoComplemento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_complemento')->delete();        
        DB::table('tipo_complemento')->insert([            
            ['Nombre_Tipo_Complemento' => 'Ayudas ergogénicas'],
            ['Nombre_Tipo_Complemento' => 'Complementos'],
            ['Nombre_Tipo_Complemento' => 'Hidratantes'],
            ['Nombre_Tipo_Complemento' => 'Otros'],
        ]);
    }
}

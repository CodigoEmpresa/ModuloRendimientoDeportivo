<?php

use Illuminate\Database\Seeder;

class Complemento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complemento')->delete();        
        DB::table('complemento')->insert([            
            ['Tipo_Complemento_Id' => '3', 'Nombre_Complemento' => 'Gatorade', 'Valor_Complemento' => '18000'],
            ['Tipo_Complemento_Id' => '3', 'Nombre_Complemento' => 'Isostar', 'Valor_Complemento' => '43953'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'BCAA', 'Valor_Complemento' => '60000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Barras energeticas', 'Valor_Complemento' => '8500'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Creatina', 'Valor_Complemento' => '70000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Gel con cafeina', 'Valor_Complemento' => '7491'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Gel sin cafeina', 'Valor_Complemento' => '7491'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Megacarbs', 'Valor_Complemento' => '30000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Waximaize', 'Valor_Complemento' => '65000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Potenciator', 'Valor_Complemento' => '3625'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Mega energy', 'Valor_Complemento' => '1000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Gomas deportivas', 'Valor_Complemento' => '6000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Multivitaminico', 'Valor_Complemento' => '5232'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Sales efervecentes', 'Valor_Complemento' => '16900'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Sales capsulas', 'Valor_Complemento' => '63000'],
            ['Tipo_Complemento_Id' => '1', 'Nombre_Complemento' => 'Sales efervecentes ZYM', 'Valor_Complemento' => '16900'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Ensure 400 gr Tarro', 'Valor_Complemento' => '37000'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Ensure 900 gr Tarro', 'Valor_Complemento' => '78000'],            
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Enterex Tarro', 'Valor_Complemento' => '57100'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Hamer Recovery Tarro', 'Valor_Complemento' => '132000'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Salufit Tarro', 'Valor_Complemento' => '42000'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Proteina Fuxion 908 gr', 'Valor_Complemento' => '203489'],            
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Prowhey Tarro 275 gr', 'Valor_Complemento' => '83000'],
            ['Tipo_Complemento_Id' => '2', 'Nombre_Complemento' => 'Proteina líquida New Whey Tubo', 'Valor_Complemento' => '13000'],
            ['Tipo_Complemento_Id' => '4', 'Nombre_Complemento' => 'Otros', 'Valor_Complemento' => '0'],
        ]);
    }
}
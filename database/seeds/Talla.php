<?php

use Illuminate\Database\Seeder;

class Talla extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voTipo_Talla_Id
     */
    public function run()
    {
         DB::table('talla')->delete();        
        DB::table('talla')->insert([
            /*ROPA FEMENINO*/
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '32', 'Uk' => '4', 'Usa' => 'XS'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '34', 'Uk' => '6', 'Usa' => 'S'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '36', 'Uk' => '8', 'Usa' => 'S'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '38', 'Uk' => '10', 'Usa' => 'M'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '40', 'Uk' => '12', 'Usa' => 'M'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '42', 'Uk' => '14', 'Usa' => 'L'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '44', 'Uk' => '16', 'Usa' => 'L'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '46', 'Uk' => '18', 'Usa' => 'XL'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '48', 'Uk' => '20', 'Usa' => '1X'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '50', 'Uk' => '22', 'Usa' => '2X'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '2', 'Eu' => '52', 'Uk' => '24', 'Usa' => '3X'],
            
            
            /*ROPA MASCULINO*/            
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '38', 'Uk' => '28', 'Usa' => 'XS'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '40', 'Uk' => '30', 'Usa' => 'S'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '42', 'Uk' => '32', 'Usa' => 'S'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '44', 'Uk' => '34', 'Usa' => 'M'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '46', 'Uk' => '36', 'Usa' => 'M'],
            //['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '48', 'Uk' => '38', 'Usa' => 'L'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '50', 'Uk' => '40', 'Usa' => 'L'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '52', 'Uk' => '42', 'Usa' => 'XL'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '54', 'Uk' => '44', 'Usa' => '1X'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '56', 'Uk' => '46', 'Usa' => '2X'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '58', 'Uk' => '48', 'Usa' => '3X'],
          /*  ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '38', 'Uk' => '28', 'Usa' => '28'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '40', 'Uk' => '30', 'Usa' => '30'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '42', 'Uk' => '32', 'Usa' => '32'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '44', 'Uk' => '34', 'Usa' => '34'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '46', 'Uk' => '36', 'Usa' => '36'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '48', 'Uk' => '38', 'Usa' => '38'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '50', 'Uk' => '40', 'Usa' => '40'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '52', 'Uk' => '42', 'Usa' => '42'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '54', 'Uk' => '44', 'Usa' => '44'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '56', 'Uk' => '46', 'Usa' => '46'],
            ['Tipo_Talla_Id' => '1', 'Genero_Id' => '1', 'Eu' => '58', 'Uk' => '48', 'Usa' => '48'],*/
            
            /*CALZADO FEMENINO*/
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '35', 'Uk' => '2.5', 'Usa' => '5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '35.5', 'Uk' => '3', 'Usa' => '5.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '36', 'Uk' => '3.5', 'Usa' => '6'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '37', 'Uk' => '4', 'Usa' => '6.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '37.5', 'Uk' => '4.5', 'Usa' => '7'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '38', 'Uk' => '5', 'Usa' => '8'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '39', 'Uk' => '6', 'Usa' => '8.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '40', 'Uk' => '6', 'Usa' => '9'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '41', 'Uk' => '7', 'Usa' => '9.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '2', 'Eu' => '42', 'Uk' => '7.5', 'Usa' => '10'],
            
                     
            /*CALZADO MASCULINO*/
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '37.5', 'Uk' => '5.5', 'Usa' => '6'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '38', 'Uk' => '6', 'Usa' => '6.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '38.5', 'Uk' => '6.5', 'Usa' => '7'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '39', 'Uk' => '7', 'Usa' => '7.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '39.5', 'Uk' => '7.5', 'Usa' => '8'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '40', 'Uk' => '8', 'Usa' => '8.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '41', 'Uk' => '8.5', 'Usa' => '9'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '42', 'Uk' => '9', 'Usa' => '9.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '43', 'Uk' => '9.5', 'Usa' => '10'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '44', 'Uk' => '10', 'Usa' => '10.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '45', 'Uk' => '10.5', 'Usa' => '11'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '34', 'Uk' => '3', 'Usa' => '3.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '35', 'Uk' => '3.5', 'Usa' => '4'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '36', 'Uk' => '4', 'Usa' => '4.5'],
            ['Tipo_Talla_Id' => '2', 'Genero_Id' => '1', 'Eu' => '37', 'Uk' => '4.5', 'Usa' => '5'],
          
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class Etapa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('etapa')->delete();
        DB::table('etapa')->insert([
            
            /************CONVENCIONAL NACIONAL************/
            ['Nombre_Etapa' => 'RESERVA DEPORTIVA I', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'RESERVA DEPORTIVA II', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL I', 'Estimulo'=>'0.5', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL II', 'Estimulo'=>'1.0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL III', 'Estimulo'=>'1.25', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL IV', 'Estimulo'=>'1.5', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL V', 'Estimulo'=>'1.75', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL VI', 'Estimulo'=>'2.0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL VII', 'Estimulo'=>'2.5', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'ÉLITE NACIONAL VIII', 'Estimulo'=>'3.0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'RETIRADO', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 1],
            ['Nombre_Etapa' => 'NO APLICA', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 1],
            
            /************CONVENCIONAL INTERNACIONAL************/            
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL I', 'Estimulo'=>'0.5', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL II', 'Estimulo'=>'1.0', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL III', 'Estimulo'=>'1.25', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL IV', 'Estimulo'=>'1.5', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL V', 'Estimulo'=>'1.75', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL VI', 'Estimulo'=>'2.0', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL VII', 'Estimulo'=>'3.0', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'RETIRADO', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 2],
            ['Nombre_Etapa' => 'NO APLICA', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 2],
            
            /*****PARALIMPICO NACIONAL*******/            
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL I', 'Estimulo'=>'1.0', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL II', 'Estimulo'=>'1.0', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL III', 'Estimulo'=>'1.5', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL IV', 'Estimulo'=>'2.0', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL V', 'Estimulo'=>'2.5', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'ÉLITE PARANACIONAL VI', 'Estimulo'=>'3.0', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'RETIRADO', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 3],
            ['Nombre_Etapa' => 'NO APLICA', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 3],
            
            /*****PARALIMPICO INTERNACIONAL*******/            
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL I', 'Estimulo'=>'0.5', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL II', 'Estimulo'=>'1.0', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL III', 'Estimulo'=>'1.5', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL IV', 'Estimulo'=>'2.0', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'ÉLITE INTERNACIONAL V', 'Estimulo'=>'3.0', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'RETIRADO', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 4],
            ['Nombre_Etapa' => 'NO APLICA', 'Estimulo'=>'0', 'Tipo_Etapa_Id' => 4],
    
        ]);
    }
}

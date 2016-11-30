<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ClasificacionDeportista::class);
         $this->call(EstadoCivil::class);
         $this->call(Estrato::class);
         $this->call(NivelRegimenSub::class);
         $this->call(Parentesco::class);
         $this->call(RegimenSalud::class);   
         $this->call(TipoAfiliacion::class);
         $this->call(TipoCuenta::class);
         $this->call(Banco::class);
         $this->call(TipoTalla::class);
         $this->call(Talla::class);
         $this->call(Arl::class);
         $this->call(FondoPension::class);
         $this->call(TipoEtapa::class);
         $this->call(Etapa::class);
         $this->call(TipoActividad::class);
         $this->call(TipoComplemento::class);
         $this->call(Complemento::class);
         $this->call(Apoyo::class);
         $this->call(TipoAlimentacion::class);
         $this->call(Alimentacion::class);
         $this->call(TipoEvaluacion::class);
         $this->call(TipoNivel::class);
    }
}

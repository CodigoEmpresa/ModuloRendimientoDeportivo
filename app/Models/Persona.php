<?php

namespace App\Models;

use Idrd\Usuarios\Repo\Persona as MPersona;

class Persona extends MPersona
{
     public function deportista()
    {
        return $this->hasOne('App\Models\Deportista', 'Persona_Id');
    }

    public function Actividades()
	{
		return $this->belongsToMany('App\Models\ActividadesSim', 'actividad_acceso', 'Id_Persona', 'Id_Actividad');
	}

	public function acceso()
    {
        return $this->belongsTo('App\Models\Acceso', 'Id_Persona');
    }    

    public function metodologoAgrupacion() {
        return $this->belongsToMany('App\Models\Agrupacion', 'metodologo_agrupacion', 'Persona_Id', 'Agrupacion_Id');
    }
}

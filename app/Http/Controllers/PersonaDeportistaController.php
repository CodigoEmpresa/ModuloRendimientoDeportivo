<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Idrd\Usuarios\Controllers\PersonaController as MPersonaController;

use App\Models\Persona;


class PersonaDeportistaController extends MPersonaController
{    
	public function buscarPersona(Request $request, $id_persona){
		$Persona = Persona::with('tipo', 'tipoDocumento', 'pais', 'genero', 'etnia', 'deportista', 'deportista.deportistaParalimpico', 'deportista.deportistaValoracion')->find($id_persona);
		return $Persona;
	}
}
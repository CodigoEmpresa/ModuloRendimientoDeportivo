<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Idrd\Usuarios\Controllers\PersonaController as MPersonaController;

use App\Models\Persona;


class PersonaDeportistaController extends MPersonaController
{    
	public function buscarPersona(Request $request, $id_persona){
		$Persona = Persona::with('tipo', 
                			 'tipoDocumento', 
                			 'pais', 
                			 'genero', 
                			 'etnia', 
                			 'deportista', 
                        		 'deportista.deportistaValoracion', 
                        		 'deportista.deportistaValoracion.idioma', 
                        		 'deportista.deportistaValoracion.quien', 
                        		 'deportista.deportistaValoracion.preguntaA',
                        		 'deportista.deportistaValoracion.valoracionRiesgo', 
                        		 'deportista.deportistaVisita',
                        		 'deportista.deportistaVisita.preguntaA',
                        		 'deportista.deportistaVisita.miembros',
                        		 'deportista.deportistaParalimpico',
                        		 'entrenador', 
                        		 'entrenador.entrenadorDeportista', 
                        		 'entrenador.entrenadorDeportista.persona', 
                        		 'entrenador.entrenadorDeportista.deportistaDeporte', 
                        		 'entrenador.entrenadorDeportista.deportistaDeporte.agrupacion', 
                        		 'entrenador.entrenadorDeportista.deportistaDeporte.deporte', 
                        		 'entrenador.entrenadorDeportista.deportistaDeporte.modalidad')
                        		->find($id_persona);
		return $Persona;
	}
}
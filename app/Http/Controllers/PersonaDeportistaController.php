<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Idrd\Usuarios\Controllers\PersonaController as MPersonaController;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Models\Persona;


class PersonaDeportistaController extends MPersonaController
{
    protected $repositorio_personas;

    public function __construct(PersonaInterface $repositorio_personas) {
        $this->repositorio_personas = $repositorio_personas;
    }

    public function buscarPersona(Request $request, $id_persona) {
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
                             'deportista.deportistaEntrenador.persona',
                             'deportista.deportistaHistoriaInicial',
                             /*'deportista.deportistaHistoriaInicial.historiaInicialConsulta',
                             'deportista.deportistaHistoriaInicial.historiaInicialExamenFisico',
                             'deportista.deportistaHistoriaInicial.historiaInicialGinecologico',
                             'deportista.deportistaHistoriaInicial.historiaInicialOsteomuscular',
                             'deportista.deportistaHistoriaInicial.historiaInicialPatologico',
                             'deportista.deportistaHistoriaInicial.historiaInicialResultado',*/
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

	public function buscarDeportista(Request $request, $key) {
        $resultados = $this->repositorio_personas->buscar($key);

        $deportistas = Persona::has('deportista')
                ->with('deportista')
                ->whereIn('Id_Persona', $resultados->lists('Id_Persona'))
                ->get();

        return $deportistas;
    }
}
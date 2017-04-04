<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Entrenador;
use App\Models\Deporte;

class GestorEntrenamientosController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		$Entrenadores = Entrenador::with('deporte', 'clasificacionDeportiva')->where('Persona_Id', $_SESSION['Usuario'][0])->get();
		$Entrenador = $Entrenadores[0];
		$Persona = $_SESSION['Usuario']['Persona'];
		return view('TECNICO/entrenamiento')
					->with(compact('Entrenador'))
					->with(compact('Persona'))
					;
	}
}


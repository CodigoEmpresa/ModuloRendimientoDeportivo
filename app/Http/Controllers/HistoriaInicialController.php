<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroHistoriaInicial;

use App\Models\Persona;
use App\Models\Genero;
use App\Models\EstadoCivil;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Estrato;
use App\Models\Localidad;
use App\Models\Eps;
use App\Models\ClasificacionDeportista;
use App\Models\Deportista;
use App\Models\Agrupacion;
use App\Models\Deporte;
use App\Models\DeportistaDeporte;
use App\Models\PersonaTipo;
use App\Models\DeportistaParalimpico;
use App\Models\Modalidad;
use App\Models\Discapacidad;
use App\Models\Ocupacion;
use App\Models\NivelEstudio;
use App\Models\Dominancia;
use App\Models\Aptitud;
use App\Models\HistoriaInicial;

class HistoriaInicialController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){

		$Ciudad = Ciudad::all();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$Departamento = Departamento::all();
		$EstadoCivil = EstadoCivil::all();
		$Estrato = Estrato::all();
		$Localidad = Localidad::all();		
		$Eps = Eps::all();
		$deportista = array();
		$Pais = Pais::all();
		$Genero = Genero::all();		
		$Discapacidad = Discapacidad::all();
		$Ocupacion = Ocupacion::all();
		$NivelEstudio = NivelEstudio::all();
		$Dominancia = Dominancia::all();
		$Aptitud = Aptitud::all();

		return view('UCAD/historia_inicial',['deportista' => $deportista])
		->with(compact('Ciudad'))
		->with(compact('ClasificacionDeportista'))
		->with(compact('Departamento'))
		->with(compact('EstadoCivil'))
		->with(compact('Estrato'))
		->with(compact('Localidad'))		
		->with(compact('Eps'))
		->with(compact('Pais'))
		->with(compact('Genero'))			
		->with(compact('ClasificacionFuncional'))
		->with(compact('Discapacidad'))
		->with(compact('Ocupacion'))
		->with(compact('NivelEstudio'))
		->with(compact('Dominancia'))
		->with(compact('Aptitud'))
		;
	}

	public function GetHistoriaUnica(Request $request, $id_historia_inicial){
		$HistoriaInicial = HistoriaInicial::find($id_historia_inicial);
		return $HistoriaInicial;

	}

	public function AgregarHistoriaInicial(RegistroHistoriaInicial $request){
		dd($request->all());
		/*"persona" => "1307"
  "deportista" => "3"
  "Ocupacion" => ""
  "NivelEstudio" => ""
  "Dominancia" => ""
  "NombreMadre" => ""
  "NombrePadre" => ""
  "EdadDeportiva" => ""
  "EntrenamientoContinuoPreg" => ""
  "PlanEntrenamientoPreg" => ""
  "NombreAcudiente" => ""
  "TelefonoAcudiente" => ""
  "NombreResponsable" => ""
  "TelefonoResponsable" => ""*/
	}

}

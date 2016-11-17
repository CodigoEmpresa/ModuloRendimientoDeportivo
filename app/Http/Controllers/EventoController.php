<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Evento;
use App\Models\ClasificacionDeportista;
use App\Models\TipoNivel;

class EventoController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		$Evento = Evento::with('clasificacionDeportiva', 'tipoNivel')->get();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$TipoNivel = TipoNivel::all();
		return view('TECNICO/evento')
				->with(compact('Evento'))
				->with(compact('ClasificacionDeportista'))
				->with(compact('TipoNivel'))
				;
	}

	public function GetEvento(Request $request, $id){
		$Evento = Evento::with('clasificacionDeportiva', 'tipoNivel')->find($id);
		return $Evento;
	}

	public function AgregarEvento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Clasificacion_Id' => 'required',
    			'Tipo_Nivel_Id' => 'required',
    			'Nombre_Evento' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Evento = new Evento;
	        	$Evento->Clasificacion_Deportista_Id = $request->Clasificacion_Id;
	        	$Evento->Tipo_Nivel_Id = $request->Tipo_Nivel_Id;
	        	$Evento->Nombre_Evento = $request->Nombre_Evento;
	        	$Evento->save();

				return response()->json(["Mensaje" => "Evento agregado con éxito!", "Id" => $Evento->Id]);			
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function EliminarEvento(Request $request){
		if ($request->ajax()) { 

			$Evento = Evento::find($request->Id_EventoE);
			if($Evento->delete()){
				return response()->json(["Mensaje" => "Evento eliminado con éxito!", "Id" => $Evento->Id]);			
			}else{
				return response()->json(array('status' => 'error'));
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}
}

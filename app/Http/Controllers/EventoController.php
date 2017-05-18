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
use App\Models\Deporte;
use App\Models\EventoDeporte;


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
		$Evento = Evento::with('clasificacionDeportiva.agrupacion.deporte', 'tipoNivel', 'deporte')->find($id);
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

	public function ModificarEvento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			  "Id_EventoDatos" => "required",
				  "Clasificacion_IdDatos" => "required",
				  "Tipo_Nivel_IdDatos" => "required",
				  "Nombre_EventoDatos" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Evento = Evento::find($request['Id_EventoDatos']);
	        	$Evento->Clasificacion_Deportista_Id = $request->Clasificacion_IdDatos;
	        	$Evento->Tipo_Nivel_Id = $request->Tipo_Nivel_IdDatos;
	        	$Evento->Nombre_Evento = $request->Nombre_EventoDatos;
	        	$Evento->save();

				return response()->json(["Mensaje" => "Evento modificado con éxito!", "Id" => $Evento->Id]);			
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

	public function AgregarDeporteEvento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_EventoDep' => 'required',
    			'Deporte_Id' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$EventoDeporte = new EventoDeporte;
	        	$EventoDeporte->Evento_Id = $request->Id_EventoDep;
	        	$EventoDeporte->Deporte_Id = $request->Deporte_Id;
	        	$EventoDeporte->save();

				return response()->json(["Mensaje" => "El deporte ha sido agregado al evento con éxito!"]);			
			}
		}else{
			return response()->json(["Sin acceso"]);
		}		
	}

	public function GetDeportesEvento(Request $request, $id){//Deportes asociados a un evento
		$Evento = Evento::with('deporte', 'deporte.agrupacion', 'deporte.agrupacion.ClasificacionDeportista')->find($id);
		return ($Evento);

	}

	public function GetDeportesNoEvento(Request $request, $id){//Trae los deportes que no estan asociados al evento
		$Evento = Evento::with('deporte')->find($id);
		$deportesList = $Evento->deporte->lists('Id');
		$deportes = Deporte::whereNotIn('Id', $deportesList)->get();
		return($deportes);
	}

	public function EliminarDeporteEvento (Request $request, $id_dep, $id_eve){
		if ($request->ajax()) { 
	        	if($EventoDeporte = EventoDeporte::where('Evento_Id', '=', $id_eve)->where('Deporte_Id', '=', $id_dep)->delete()){
	        		return response()->json(["Mensaje" => "El deporte ha sido desvinculado al evento con éxito!"]);			
	        	}else{
	        		return response()->json(array('status' => 'error', 'Mensaje' => 'Ha ocurrido un error, por favor intentelo nuevamente!'));
	        	}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Certamen;
use App\Models\Evento;
use App\Models\Pais;
use App\Models\Ciudad;


class CertamenController extends Controller
{
   public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		$Evento = Evento::all();
		$Certamen = Certamen::with('evento')->get();
		$Certamen = Certamen::all();
		/*$ClasificacionDeportista = ClasificacionDeportista::all();
		$TipoNivel = TipoNivel::all();*/
		return view('TECNICO/certamen')
				->with(compact('Evento'))
				->with(compact('Certamen'))
				/*->with(compact('ClasificacionDeportista'))
				->with(compact('TipoNivel'))*/
				;
	}

	public function getEvento(Request $request, $id){
		$Evento = Evento::find($id);
		return $Evento;
	}

	public function GetPaises(Request $request){
		$Pais = Pais::all();
		return $Pais;
	}

	public function GetCiudades(Request $request){
		$Ciudad = Ciudad::all();
		return $Ciudad;
	}

	public function AgregarCertamen(Request $request){
	
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			//'Id_Certamen' => 'required',
    			'Evento_Id' => 'required',
    			'Sede_Id' => 'required',
    			'FechaInicio' => 'required|date',
    			'FechaFin' => 'required|date',

    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Certamen = new Certamen;
	        	$Certamen->Evento_Id = $request->Evento_Id;
	        	$Certamen->Sede_Id = $request->Sede_Id;
	        	$Certamen->Fecha_Inicio = $request->FechaInicio;
	        	$Certamen->Fecha_Fin = $request->FechaFin;

	        	$FIni= explode('-', $request->FechaInicio);
	        	$Nombre = $request->Nombre_Certamen.' '.$FIni[1].'/'.$FIni[0][2].$FIni[0][3];

	        	$Certamen->Nombre_Certamen = $Nombre;
	        	if($Certamen->save()){
	        		return response()->json(["Mensaje" => "Certamen agregado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "El certamen no ha sido agregado!"]);			
	        	}				
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetCertamen(Request $request, $id){
		$Certamen = Certamen::find($id);
		return $Certamen;
	}
}
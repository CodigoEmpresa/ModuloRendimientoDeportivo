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
use App\Models\Division;
use App\Models\CertamenDivision;
use App\Models\CertamenDivisionDeportista;
use App\Models\Deportista;
use App\Models\Deporte;
use App\Models\Departamento;

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
		return view('TECNICO/certamen')
				->with(compact('Evento'))
				->with(compact('Certamen'));
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

	public function ModificarCertamen(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_CertamenE' => 'required',
    			'Evento' => 'required',
    			'Sede' => 'required',
    			'FechaInicioM' => 'required|date',
    			'FechaFinM' => 'required|date',

    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Certamen = Certamen::find($request['Id_CertamenE']);
	        	$Certamen->Evento_Id = $request->Evento;
	        	$Certamen->Sede_Id = $request->Sede;
	        	$Certamen->Fecha_Inicio = $request->FechaInicioM;
	        	$Certamen->Fecha_Fin = $request->FechaFinM;

	        	$FIni= explode('-', $request->FechaInicioM);
	        	$Nombre = $request->Nombre_CertamenE.' '.$FIni[1].'/'.$FIni[0][2].$FIni[0][3];

	        	$Certamen->Nombre_Certamen = $Nombre;
	        	if($Certamen->save()){
	        		return response()->json(["Mensaje" => "Certamen modificado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "El certamen no ha sido modificado!"]);			
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

	public function GetDivision(Request $request, $id, $id_certamen){
		$Certamen = Certamen::with('division')->find($id_certamen);
		$certamenList = $Certamen->division->lists('Id');
		$Division = Division::with('Rama', 'Categoria')->where('Deporte_Id', '=', $id)->whereNotIn('Id', $certamenList)->get();
		return($Division);
	}

	public function GetDivisionCertamen(Request $request, $id){
		$Certamen = Certamen::with('division', 'division.Agrupacion', 'division.Deporte', 'division.Rama', 'division.Categoria')->find($id);
		return($Certamen);
	}

	public function AgregarPruebaCertamen(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_CertamenP' => 'required',
    			'Deporte_Id' => 'required',
    			'Prueba_Id' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$CertamenDivision = new CertamenDivision;
	        	$CertamenDivision->Certamen_Id = $request->Id_CertamenP;
	        	$CertamenDivision->Division_Id = $request->Prueba_Id;

	        	if($CertamenDivision->save()){
	        		return response()->json(["Mensaje" => "La prueba ha sido agregada de forma exitosa al certamen!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "La prueba  no ha sido agregada al certamen!"]);			
	        	}	
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function EliminarPruebaCertamen(Request $request, $id_prueba, $id_certamen){
		if ($request->ajax()) { 
        	if($CertamenDivision = CertamenDivision::where('Certamen_Id', '=', $id_certamen)->where('Division_Id', '=', $id_prueba)->delete()){
        		return response()->json(["Mensaje" => "Esta prueba ha sido desvinculada al certamen con éxito!"]);			
        	}else{
        		return response()->json(array('status' => 'error', 'Mensaje' => 'Ha ocurrido un error, por favor intentelo nuevamente!'));
        	}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetDivisionDeportista(Request $request, $id_division){
		$Division = Division::find($id_division);
		return $Division;
	}

	public function GetDeportistaDivision(Request $request, $id_deporte){
		$Deporte = Deporte::with('deportista', 'deportista.Persona')->find($id_deporte);
		return $Deporte;
	}

	public function AgregarPruebaCertamenDeportista(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_CertamenD' => 'required',
    			'Prueba_IdD' => 'required',
    			'Deportista_IdD' => 'required',
    			]);
	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$CertamenDivision = CertamenDivision::where('Certamen_Id', '=', $request->Id_CertamenD)->where('Division_Id', '=', $request->Prueba_IdD)->get();
				$CertamenDivisionDeportista = CertamenDivisionDeportista::where('CertamenDivision_Id', '=', $CertamenDivision[0]->Id)->where('Deportista_Id', '=', $request->Deportista_IdD)->get();
				if(count($CertamenDivisionDeportista) < 1){
					$CertamenDivisionDeportista = new CertamenDivisionDeportista;
		        	$CertamenDivision = CertamenDivision::where('Division_Id', '=', $request->Prueba_IdD)->where('Certamen_Id', '=', $request->Id_CertamenD)->get();
		        	$CertamenDivisionDeportista->CertamenDivision_Id = $CertamenDivision[0]->Id;
		        	$CertamenDivisionDeportista->Deportista_Id = $request->Deportista_IdD;

		        	if($CertamenDivisionDeportista->save()){
		        		return response()->json(["Mensaje" => "Este deportista ha sido vinculado a al prueba de forma exitosa al certamen!"]);				        		
		        	}else{
		        		return response()->json(["Mensaje" => "El deportista no ha sido vinculado a la prueba con éxito!"]);			
		        	}		
				}else{
					return response()->json(array('status' => 'ErrorAdicion', 'Mensaje' => 'Esta usuario ya se encuentra vinculado a esta prueba.',));
				}
	        	
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetDeportistaCertamenDivision(Request $request, $id_certamen){
		$Deportista = Deportista::with(['persona', 'certamenDivision' => function($query) use ($id_certamen)
								{
									$query->where('Certamen_Id', $id_certamen);
								}])->get();
		return $Deportista;
	}

	public function GetDivisionUnica(Request $request, $id_division){
		$Division = Division::with('Rama', 'Categoria', 'Deporte')->find($id_division);
		return $Division;
	}

	
	public function EliminarPruebaCertamenDeportista(Request $request, $id_deportista, $id_division, $id_certamen){
		if ($request->ajax()) { 

			$CertamenDivision = CertamenDivision::where('Certamen_Id', '=', $id_certamen)->where('Division_Id', '=', $id_division)->get();

        	if($CertamenDivisionDeportista = CertamenDivisionDeportista::where('CertamenDivision_Id', '=', $CertamenDivision[0]->Id)->where('Deportista_Id', '=', $id_deportista)->delete()){
        		return response()->json(["Mensaje" => "Este deportista ha sido desvinculado de la pruebacon éxito!"]);			
        	}else{
        		return response()->json(array('status' => 'error', 'Mensaje' => 'Ha ocurrido un error, por favor intentelo nuevamente!'));
        	}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetDepartamento(Request $request){
		$Departamento = Departamento::all();
		return $Departamento;
	}
}
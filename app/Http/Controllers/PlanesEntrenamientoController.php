<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\PlanEntrenamiento;
use App\Models\Entrenador;
use App\Models\Deportista;
use App\Models\VersionPlanEntrenamiento;


class PlanesEntrenamientoController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		return view('TECNICO/planes');
	}

	public function AgregarPlanEntrenamiento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), ['Archivo_Word_NuevoInput' => 'required|mimes:doc,docx', 'Archivo_Excel_NuevoInput' => 'required|mimes:xls,xlsx']);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{

	        	$ConteoPE = PlanEntrenamiento::where('Deportista_Id', $request->Id_Deportista)->count();
    			$Entrenador = Entrenador::where('Persona_Id', $_SESSION['Usuario'][0])->get();

			 	$file1=$request->file('Archivo_Word_NuevoInput');
	            $extension1 = $file1->getClientOriginalExtension();
	            $Nombre_Archivo = "PlanEntrenamiento-".$request->Id_Deportista.'-WdN'.($ConteoPE+1).'.'.$extension1;
	            $file1->move(public_path().'/Img/PlanEntrenamiento/Plan/', $Nombre_Archivo);

	            $file2=$request->file('Archivo_Excel_NuevoInput');
	            $extension2=$file2->getClientOriginalExtension();
	            $Nombre_Archivo2 = "PlanEntrenamiento-".$request->Id_Deportista.'-ExN'.($ConteoPE+1).'.'.$extension2;
	            $file2->move(public_path().'/Img/PlanEntrenamiento/Plan/', $Nombre_Archivo2);

	        	$PlanEntrenamiento = new PlanEntrenamiento;
				$PlanEntrenamiento->Deportista_Id = $request->Id_Deportista;
				$PlanEntrenamiento->Entrenador_Id = $Entrenador[0]['Id'];
				$PlanEntrenamiento->Url_Word = '/Img/PlanEntrenamiento/Plan/'.$Nombre_Archivo;
				$PlanEntrenamiento->Url_Excel = '/Img/PlanEntrenamiento/Plan/'.$Nombre_Archivo2;
				$PlanEntrenamiento->Numero_Plan = $ConteoPE+1;

				if($PlanEntrenamiento->save()){
					return response()->json(["Estado" => "Success", "Mensaje" => "Archivos agregados con éxito."]);                	
				}else{
					return response()->json(["Estado" => "Error", "Mensaje" => "No se logro la carga de archivos, por favor inténtelo más tarde."]);                
				}
	        }    		
    	}else{
    		return response()->json(["Estado" => "Error", "Mensaje" => "Sin accesso!"]);
    	}
	}

	public function GetPlanActual(Request $request, $id_deportista){
		$PlanEntrenamiento = Deportista::with('planEntrenamiento')->find($id_deportista);
		return $PlanEntrenamiento->planEntrenamiento->last();
	}

	public function AgregarObservaciones(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_PLanActual' => 'required',
    			'ObservacionMetodologo' => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
    			'ObservacionEntrenador' => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$PlanEntrenamiento = planEntrenamiento::find($request->Id_PLanActual);
	        	if($request->ObservacionMetodologo != ''){
	        		$PlanEntrenamiento->Observacion_Metodologo = $request->ObservacionMetodologo;
	        	}
	        	if($request->ObservacionEntrenador != ''){
	        		$PlanEntrenamiento->Observacion_Entrenador = $request->ObservacionEntrenador;
	        	}

	        	if($PlanEntrenamiento->save()){
	        		return response()->json(["Mensaje" => "Observación agregada con éxito!", "Estado" => 'Success']);				
	        	}else{
	        		return response()->json(["Mensaje" => "Ocurrio un fallo, por favor intente nuevamente!", "Estado" => 'Error']);
	        	}			
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetHistorialPlan(Request $request, $id_deportista){
		$PlanEntrenamiento = Deportista::with('planEntrenamiento', 'planEntrenamiento.entrenador.persona')->find($id_deportista);
		return $PlanEntrenamiento->planEntrenamiento;
	}

	public function GetPlanUnico(Request $request, $id_plan){
		$PlanEntrenamiento = PlanEntrenamiento::find($id_plan);
		return $PlanEntrenamiento;
	}

	public function AgregarPlanEntrenamientoActualizacion(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_PLanActual_A' => 'required', 
    			'Archivo_Word_NuevoInput_Actualizacion' => 'required|mimes:doc,docx', 
    			'Archivo_Excel_NuevoInput_Actualizacion' => 'required|mimes:xls,xlsx'
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{

	        	$ConteoPE = VersionPlanEntrenamiento::where('Plan_Entrenamiento_Id', $request->Id_PLanActual_A)->count();

	        	$file1=$request->file('Archivo_Word_NuevoInput_Actualizacion');
	            $extension1 = $file1->getClientOriginalExtension();
	            $Nombre_Archivo = "PlanEntrenamiento-Version".$request->Id_PLanActual_A.'WdN'.($ConteoPE+1).'.'.$extension1;
	            $file1->move(public_path().'/Img/PlanEntrenamiento/Version/', $Nombre_Archivo);

	        	$file2=$request->file('Archivo_Excel_NuevoInput_Actualizacion');
	            $extension2=$file2->getClientOriginalExtension();
	            $Nombre_Archivo2 = "PlanEntrenamiento-Version".$request->Id_PLanActual_A.'ExN'.($ConteoPE+1).'.'.$extension2;
	            $file2->move(public_path().'/Img/PlanEntrenamiento/Version/', $Nombre_Archivo2);

	            $VersionPlanEntrenamiento = new VersionPlanEntrenamiento;
	            $VersionPlanEntrenamiento->Plan_Entrenamiento_Id = (integer)$request->Id_PLanActual_A;
	            $VersionPlanEntrenamiento->Url_Word = '/Img/PlanEntrenamiento/Version/'.$Nombre_Archivo;
	            $VersionPlanEntrenamiento->Url_Excel = '/Img/PlanEntrenamiento/Version/'.$Nombre_Archivo2;
	            $VersionPlanEntrenamiento->Numero_Version = $ConteoPE+1;
	            if($VersionPlanEntrenamiento->save()){
					return response()->json(["Estado" => "Success", "Mensaje" => "Archivos para actualización agregados con éxito."]);                	
				}else{
					return response()->json(["Estado" => "Error", "Mensaje" => "No se logro la carga de archivos, por favor inténtelo más tarde."]);                
				}
	        }    		
    	}else{
    		return response()->json(["Estado" => "Error", "Mensaje" => "Sin accesso!"]);
    	}
	}

	public function GetHistorialPlanActual(Request $request, $id_plan){
		$VersionPlanEntrenamiento = VersionPlanEntrenamiento::where('Plan_Entrenamiento_Id', $id_plan)->get();
		return $VersionPlanEntrenamiento;
	}

	public function GetVersionUnica(Request $request, $id_version){
		$VersionPlanEntrenamiento = VersionPlanEntrenamiento::find($id_version);
		return $VersionPlanEntrenamiento;
	}

	public function GetVersionActual (Request $request, $id_plan){
		$VersionPlanEntrenamiento = PlanEntrenamiento::with('versionPlanEntrenamiento')->find($id_plan);
		return $VersionPlanEntrenamiento->versionPlanEntrenamiento->last();
	}

	public function AgregarObservacionesVersion(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_UltimaVersion' => 'required',
    			'ObservacionMetodologoUV' => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
    			'ObservacionEntrenadorUV' => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$versionPlanEntrenamiento = versionPlanEntrenamiento::find($request->Id_UltimaVersion);
	        	if($request->ObservacionMetodologoUV != ''){
	        		$versionPlanEntrenamiento->Observacion_Metodologo = $request->ObservacionMetodologoUV;
	        	}
	        	if($request->ObservacionEntrenadorUV != ''){
	        		$versionPlanEntrenamiento->Observacion_Entrenador = $request->ObservacionEntrenadorUV;
	        	}

	        	if($versionPlanEntrenamiento->save()){
	        		return response()->json(["Mensaje" => "Observación agregada con éxito!", "Estado" => 'Success']);				
	        	}else{
	        		return response()->json(["Mensaje" => "Ocurrio un fallo, por favor intente nuevamente!", "Estado" => 'Error']);
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}	
}
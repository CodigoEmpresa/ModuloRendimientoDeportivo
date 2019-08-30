<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Http\Requests\RegistroActividad;
use Validator;

use App\Models\TipoActividad;
use App\Models\ActividadIntervencion;

class ActividadController extends Controller
{
     public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{		
		$TipoActividad = TipoActividad::all();
		$ActividadIntervencion = ActividadIntervencion::with('tipoActividad')->get();
		return view('SIAB/actividad')
				->with(compact('TipoActividad'))
				->with(compact('ActividadIntervencion'))
				;
	}

	public function RegistrarActividad(RegistroActividad $request){
		if ($request->ajax()){
			$ActividadIntervencion = new ActividadIntervencion;
			$ActividadIntervencion->Descripcion = $request->Descripcion;
			$ActividadIntervencion->Tipo_Actividad_Id = $request->Actividad;
			$ActividadIntervencion->Otro_Actividad = $request->Otro_Actividad;			
			$ActividadIntervencion->DeportistaP = $request->DeportistaP;
			$ActividadIntervencion->DeportistaA = $request->DeportistaA;
			$ActividadIntervencion->MultidisciplinarioP = $request->MultiP;
			$ActividadIntervencion->MultidisciplinarioA = $request->MultiA;
			$ActividadIntervencion->EntrenadorP = $request->EntrenadorP;
			$ActividadIntervencion->EntrenadorA = $request->EntrenadorA;
			$ActividadIntervencion->ComisionadoP = $request->ComisionadoP;
			$ActividadIntervencion->ComisionadoA = $request->ComisionadoA;
			$ActividadIntervencion->Otros = $request->Otros;
			$ActividadIntervencion->OtrosP = $request->OtrosP;
			$ActividadIntervencion->OtrosA = $request->OtrosA;
			$ActividadIntervencion->Fecha_Programada = $request->Fecha_Programada;
			$ActividadIntervencion->Fecha_Realizacion = $request->Fecha_Realizacion;
			$ActividadIntervencion->Reprogramacion = $request->Reprogramacion;
			$ActividadIntervencion->Total_Asistentes = $request->Total_sistentes;
			$ActividadIntervencion->Observaciones = $request->Observaciones;
			$ActividadIntervencion->Total_Evaluadores = $request->Total_Evaluadores;
			$ActividadIntervencion->Nombre_Gestor = $request->Nombre_Gestor;
			$ActividadIntervencion->Nombre_Coordinador = $request->Nombre_Coordinador;
			$ActividadIntervencion->save();

			return response()->json(["Mensaje" => "Actividad registrada con éxito!"]);			
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function ModificarActividad(RegistroActividad $request){

		if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), [
    			'Anexo1Dep' => 'mimes:jpeg,jpg,png,bmp',
    			'Anexo2Dep' => 'mimes:jpeg,jpg,png,bmp',
    			'Anexo3Dep' => 'mimes:jpeg,jpg,png,bmp',
    			'Anexo4Dep' => 'mimes:jpeg,jpg,png,bmp',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	
				$ActividadIntervencion = ActividadIntervencion::find($request['ActividadId']);

				if(isset($request->Anexo1Dep)){
				 	$file1=$request->file('Anexo1Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Anexo1_Url = "Anexo1Dep-".$request['ActividadId'].'.'.$extension1;
		            $file1->move(public_path().'/Img/AnexosActividad/', $Anexo1_Url);
		            $ActividadIntervencion->Anexo1_Url = $Anexo1_Url;
		        }

		        if(isset($request->Anexo2Dep)){
				 	$file1=$request->file('Anexo2Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Anexo2_Url = "Anexo2Dep-".$request['ActividadId'].'.'.$extension1;
		            $file1->move(public_path().'/Img/AnexosActividad/', $Anexo1_Url);
		            $ActividadIntervencion->Anexo2_Url = $Anexo2_Url;
		        }

		        if(isset($request->Anexo3Dep)){
				 	$file1=$request->file('Anexo3Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Anexo3_Url = "Anexo3Dep-".$request['ActividadId'].'.'.$extension1;
		            $file1->move(public_path().'/Img/AnexosActividad/', $Anexo3_Url);
		            $ActividadIntervencion->Anexo3_Url = $Anexo3_Url;
		        }

		        if(isset($request->Anexo4Dep)){
				 	$file1=$request->file('Anexo4Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Anexo4_Url = "Anexo4Dep-".$request['ActividadId'].'.'.$extension1;
		            $file1->move(public_path().'/Img/AnexosActividad/', $Anexo4_Url);
		            $ActividadIntervencion->Anexo4_Url = $Anexo4_Url;
		        }

				$ActividadIntervencion->Descripcion = $request->Descripcion;
				$ActividadIntervencion->Tipo_Actividad_Id = $request->Actividad;
				$ActividadIntervencion->Otro_Actividad = $request->Otro_Actividad;			
				$ActividadIntervencion->DeportistaP = $request->DeportistaP;
				$ActividadIntervencion->DeportistaA = $request->DeportistaA;
				$ActividadIntervencion->MultidisciplinarioP = $request->MultiP;
				$ActividadIntervencion->MultidisciplinarioA = $request->MultiA;
				$ActividadIntervencion->EntrenadorP = $request->EntrenadorP;
				$ActividadIntervencion->EntrenadorA = $request->EntrenadorA;
				$ActividadIntervencion->ComisionadoP = $request->ComisionadoP;
				$ActividadIntervencion->ComisionadoA = $request->ComisionadoA;
				$ActividadIntervencion->Otros = $request->Otros;
				$ActividadIntervencion->OtrosP = $request->OtrosP;
				$ActividadIntervencion->OtrosA = $request->OtrosA;
				$ActividadIntervencion->Fecha_Programada = $request->Fecha_Programada;
				$ActividadIntervencion->Fecha_Realizacion = $request->Fecha_Realizada;
				$ActividadIntervencion->Reprogramacion = $request->Reprogramacion;
				$ActividadIntervencion->Total_Asistentes = $request->Total_Asistentes;
				$ActividadIntervencion->Observaciones = $request->Observaciones;
				$ActividadIntervencion->Total_Evaluadores = $request->Total_Evaluadores;
				$ActividadIntervencion->Nombre_Gestor = $request->Nombre_Gestor;
				$ActividadIntervencion->Nombre_Coordinador = $request->Nombre_Coordinador;
				$ActividadIntervencion->save();

				return response()->json(["Mensaje" => "Actividad modificada con éxito!"]);			
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function ActividadTraer(Request $request, $id){
		$ActividadIntervencion = ActividadIntervencion::find($id);
		return $ActividadIntervencion;
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Http\Requests\RegistroVisita;
use Validator;

use App\Models\Deporte;
use App\Models\VisitaDomiciliaria;
use App\Models\PreguntaAVisita;
use App\Models\VisitaMiembros;
use App\Models\Deportista;

class VisitaController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{		
		$Deporte = Deporte::all();
		$deportista = array();
		return view('SIAB/visita',['deportista' => $deportista])
				->with(compact('Deporte'))
				;
	}

	public function RegistrarVisita(RegistroVisita $request){

		if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), [
    			'GenogramaDep' => 'required|mimes:jpeg,jpg,png,bmp',
    			'Imagen1Dep' => 'required|mimes:jpeg,jpg,png,bmp',
    			'Imagen2Dep' => 'required|mimes:jpeg,jpg,png,bmp',
    			'Imagen3Dep' => 'required|mimes:jpeg,jpg,png,bmp',
    			'Imagen4Dep' => 'required|mimes:jpeg,jpg,png,bmp',
    			'Imagen5Dep' => 'mimes:jpeg,jpg,png,bmp,pdf',
    			'Imagen6Dep' => 'mimes:jpeg,jpg,png,bmp,pdf',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{

	        	$VisitaDomiciliaria = new VisitaDomiciliaria;
	        	$contador = count(VisitaDomiciliaria::All());
	        	$contador = $contador + 1;

	        	if(isset($request->GenogramaDep)){
				 	$file1=$request->file('GenogramaDep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Genograma_Url = "GenogramaDep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Genograma/', $Genograma_Url);
		            $VisitaDomiciliaria->Genograma_Url = $Genograma_Url;
		        }else{
		        	$VisitaDomiciliaria->Genograma_Url = '';
		        }

		        if(isset($request->Imagen1Dep)){
				 	$file1=$request->file('Imagen1Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen1_Url = "Imagen1Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen1_Url);
		            $VisitaDomiciliaria->Imagen1_Url = $Imagen1_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen1_Url = '';
		        }

		        if(isset($request->Imagen2Dep)){
				 	$file1=$request->file('Imagen2Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen2_Url = "Imagen2Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen2_Url);
		            $VisitaDomiciliaria->Imagen2_Url = $Imagen2_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen2_Url = '';
		        }

		        if(isset($request->Imagen3Dep)){
				 	$file1=$request->file('Imagen3Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen3_Url = "Imagen3Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen3_Url);
		            $VisitaDomiciliaria->Imagen3_Url = $Imagen3_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen3_Url = '';
		        }

		        if(isset($request->Imagen4Dep)){
				 	$file1=$request->file('Imagen4Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen4_Url = "Imagen4Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen4_Url);
		            $VisitaDomiciliaria->Imagen4_Url = $Imagen4_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen4_Url = '';
		        }

		        if(isset($request->Imagen5Dep)){
				 	$file1=$request->file('Imagen5Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen5_Url = "Imagen5Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen5_Url);
		            $VisitaDomiciliaria->Imagen5_Url = $Imagen5_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen5_Url = '';
		        }

		        if(isset($request->Imagen6Dep)){
				 	$file1=$request->file('Imagen6Dep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Imagen6_Url = "Imagen6Dep-".$request->deportista.'-Num-'.$contador.'.'.$extension1;
		            $file1->move(public_path().'/Img/Visita/', $Imagen6_Url);
		            $VisitaDomiciliaria->Imagen6_Url = $Imagen6_Url;
		        }else{
		        	$VisitaDomiciliaria->Imagen6_Url = '';
		        }

	        	
				$VisitaDomiciliaria->Deportista_Id = $request->deportista;
				$VisitaDomiciliaria->Fecha_Intervencion = $request->FechaIntervencion;
				$VisitaDomiciliaria->Nombres_Receptor = $request->NombresAtiende;
				$VisitaDomiciliaria->Apellidos_Receptor = $request->ApellidosAtiende;
				$VisitaDomiciliaria->Documento_Receptor = $request->DocumentoAtiende;
				$VisitaDomiciliaria->Vivienda = $request->op1;
				$VisitaDomiciliaria->Tipo_Vivienda = $request->op2;
				$VisitaDomiciliaria->Tipo_Vivienda_Propia = $request->op2o1;
				$VisitaDomiciliaria->Area_Vivienda = $request->pn3;
				$VisitaDomiciliaria->Tiempo_Vivienda = $request->p3;
				$VisitaDomiciliaria->Total_Habitaciones = $request->Habitacion;
				$VisitaDomiciliaria->Total_Banos = $request->Bano;
				$VisitaDomiciliaria->Total_Cocinas = $request->Cocina;
				$VisitaDomiciliaria->Total_Salas = $request->Sala;
				$VisitaDomiciliaria->Total_Comedores = $request->Comedor;
				$VisitaDomiciliaria->Total_Ropas = $request->ZRopas;
				$VisitaDomiciliaria->Otros_Distribucion = $request->OtrosDistribucion;
				$VisitaDomiciliaria->Total_Camas = $request->Camas;
				$VisitaDomiciliaria->Total_Closets = $request->Closets;
				$VisitaDomiciliaria->Total_Televisores = $request->Televisor;
				$VisitaDomiciliaria->Total_Neveras = $request->Nevera;
				$VisitaDomiciliaria->Total_Estufas = $request->Estufa;
				$VisitaDomiciliaria->Otros_Muebles = $request->OtrosMuebles;
				$VisitaDomiciliaria->Aseo = $request->op8;
				$VisitaDomiciliaria->Organizacion = $request->op9;
				$VisitaDomiciliaria->Iluminacion = $request->op10;
				$VisitaDomiciliaria->Ventilacion = $request->op11;
				$VisitaDomiciliaria->Condiciones_Vivienda = $request->op12;
				$VisitaDomiciliaria->Tipo_Ingreso = $request->op13;
				if($request->op13 == 'Otro'){
					$VisitaDomiciliaria->Otro_Ingreso = $request->otro13o4;
				}
				$VisitaDomiciliaria->Total_Ingreso = $request->TotalIngreso;
				$VisitaDomiciliaria->Egreso_Alimentacion = $request->Alimentacion;
				$VisitaDomiciliaria->Egreso_Arriendo = $request->Arriendo;
				$VisitaDomiciliaria->Egreso_Educacion = $request->Educacion;
				$VisitaDomiciliaria->Egreso_Cuota_Vivienda = $request->CuotaV;
				$VisitaDomiciliaria->Egreso_Salud = $request->Salud;
				$VisitaDomiciliaria->Egreso_Recreacion = $request->Recreacion;
				$VisitaDomiciliaria->Egreso_Servicios = $request->Servicios;
				$VisitaDomiciliaria->Egreso_Transporte = $request->Transporte;
				$VisitaDomiciliaria->Deudas = $request->op14;
				$VisitaDomiciliaria->Deudas_Quien = $request->Adeudan;
				$VisitaDomiciliaria->Total_Egresos = $request->MontoEgresos;
				$VisitaDomiciliaria->Total_Deudas = $request->MontoDeudas;
				$VisitaDomiciliaria->Situacion_Economica = $request->op15;
				$VisitaDomiciliaria->Practicas_Deportivas = $request->PracticasDeportivas;
				$VisitaDomiciliaria->Juegos_Familiares = $request->JuegosFamiliares;
				$VisitaDomiciliaria->Salidas_Publicas = $request->SalidasPublicos;
				$VisitaDomiciliaria->Quehaceres = $request->Quehaceres;
				$VisitaDomiciliaria->Actividad_Libre = $request->ActividadesLibre;
				$VisitaDomiciliaria->Actividad_Academica = $request->ActividadesAcademicas;
				$VisitaDomiciliaria->Television = $request->Television;
				$VisitaDomiciliaria->Internet = $request->Internet;
				$VisitaDomiciliaria->P16 = $request->Preg16;
				$VisitaDomiciliaria->P17 = $request->Preg17;
				$VisitaDomiciliaria->P18 = $request->Preg18;
				$VisitaDomiciliaria->P19 = $request->Preg19;
				$VisitaDomiciliaria->P20 = $request->Preg20;
				$VisitaDomiciliaria->P21 = $request->Preg21;
				$VisitaDomiciliaria->Concepto_Profesional = $request->Preg22;
				$VisitaDomiciliaria->Genograma_Observacion = $request->Genograma_Observacion;

				$VisitaDomiciliaria->save();

				/*******************PREGUNTA 4***********************/
				$contador4 = count($request->op4);
				$i = 0;
				while($i < $contador4){
					$PreguntaAVisita = new PreguntaAVisita;
					$PreguntaAVisita->Visita_Id = $VisitaDomiciliaria->Id;
					$PreguntaAVisita->PreguntaA_Id = 'P4';
					$PreguntaAVisita->Respuesta = $request->op4[$i];			
					$PreguntaAVisita->save();
					$i++;
				}

				/*******************PREGUNTA 5***********************/
				$contador5 = count($request->op5);
				$i = 0;
				while($i < $contador5){
					$PreguntaAVisita = new PreguntaAVisita;
					$PreguntaAVisita->Visita_Id = $VisitaDomiciliaria->Id;
					$PreguntaAVisita->PreguntaA_Id = 'P5';
					$PreguntaAVisita->Respuesta = $request->op5[$i];			
					$PreguntaAVisita->save();
					$i++;
				}

				/*******************PREGUNTA 6***********************/
				$contador6 = count($request->op6);
				$i = 0;
				while($i < $contador6){
					$PreguntaAVisita = new PreguntaAVisita;
					$PreguntaAVisita->Visita_Id = $VisitaDomiciliaria->Id;
					$PreguntaAVisita->PreguntaA_Id = 'P6';
					$PreguntaAVisita->Respuesta = $request->op6[$i];	
					if($request->op6[$i] == 'Gas'){
						$PreguntaAVisita->Descripcion = $request->op6o5;
					}
					if($request->op6[$i] == 'Otros'){
						$PreguntaAVisita->Descripcion = $request->otro6o6;
					}		
					$PreguntaAVisita->save();
					$i++;
				}

				/*******************PREGUNTA 7***********************/
				$contador7 = count($request->op7);
				$i = 0;
				while($i < $contador7){
					$PreguntaAVisita = new PreguntaAVisita;
					$PreguntaAVisita->Visita_Id = $VisitaDomiciliaria->Id;
					$PreguntaAVisita->PreguntaA_Id = 'P7';
					$PreguntaAVisita->Respuesta = $request->op7[$i];			
					$PreguntaAVisita->save();
					$i++;
				}

				/************************Visita Miembros**************************/
				$miembros = json_decode($request['vector_miembros']);
		       	foreach($miembros as $miembrosV){
		       		$PMiembros = new  VisitaMiembros;
		       		$PMiembros->VisitaM_Id = $VisitaDomiciliaria->Id;
		       		$PMiembros->Nombre_Miembro = $miembrosV->NombreMiembro;
		       		$PMiembros->Parentesco_Miembro = $miembrosV->ParentescoMiembro;
		       		$PMiembros->Regimen_Subsidiado = $miembrosV->NombreSubsidiado;
		       		$PMiembros->Regimen_Contributivo = $miembrosV->NombreContributivo;
		       		$PMiembros->Numero_Afiliados = $miembrosV->NumAfiliados;
		       		$PMiembros->Enfermedades = $miembrosV->Enfermedades;
		       		$PMiembros->Discapacidades = $miembrosV->Discapacidades;
		       		$PMiembros->save();
		       	}
		       	return response()->json(["Mensaje" => "Visita domiciliaria registrada con éxito!"]);
	        }
	    }else{
			return response()->json(["Sin acceso"]);
		}		
	}

	public function GetVisita(Request $request, $id){
		$Visitas = VisitaDomiciliaria::with('preguntaA', 'miembros')->find($id);
		return $Visitas;
	}

}
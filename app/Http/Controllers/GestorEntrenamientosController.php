<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;
use Carbon\Carbon;

use App\Models\Entrenador;
use App\Models\Deporte;
use App\Models\Entrenamiento;
use App\Models\Deportista;

use App\Models\DeportistaEntrenamiento;
use App\Models\EntrenadorDeportista;
use App\Models\AsistenciaEntrenamiento;
use App\Models\VerificacionEntrenamiento;
use App\Models\EntrenamientoNoConformidad;

class GestorEntrenamientosController extends Controller
{

    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){
		$Entrenadores = Entrenador::with('deporte', 'clasificacionDeportiva')->where('Persona_Id', $_SESSION['Usuario'][0])->get();
		if(count($Entrenadores) > 0){
			$Entrenador = $Entrenadores[0];
		}else{
			$Entrenador = null;
		}
		
		$Persona = $_SESSION['Usuario']['Persona'];

		return view('TECNICO/entrenamiento')
					->with(compact('Entrenador'))
					->with(compact('Persona'))
					;
	}

	public function AgregarEntrenamiento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
				"Entrenador_Id" => "required",
				"Lugar_Entrenamiento" => "required",
				"FechaInicio" => "required|date",
				"FechaFin" => "required|date",
				"HoraInicio" => "required",
				"HoraFin" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Entrenamiento = new Entrenamiento;
	        	$Entrenamiento ->Entrenador_Id = $request->Entrenador_Id;	        	
	        	$Entrenamiento ->Lugar_Entrenamiento = $request->Lugar_Entrenamiento;
	        	$Entrenamiento ->Fecha_Inicio = $request->FechaInicio;
	        	$Entrenamiento ->Fecha_Fin = $request->FechaFin;
	        	$Entrenamiento ->Hora_Inicio = $request->HoraInicio;
	        	$Entrenamiento ->Hora_Fin = $request->HoraFin;


	        	if($Entrenamiento->save()){
	        		return response()->json(["Mensaje" => "Entrenamiento agregado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "El entrenamiento no ha sido agregado!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetEntrenamientos (Request $request, $id_entrenador){
		$Entrenamientos = Entrenamiento::where('Entrenador_Id', $id_entrenador)->get();
		$Resultado = "<table id='datosEntrenamientos' name='datosEntrenamientos'>
					        <thead>
					            <tr>
									<th>LUGAR DE ENTRENAMIENTO</th>                        
			                        <th>FECHA INICIO</th>
			                        <th>FECHA FIN</th>
			                        <th>OPCIONES</th>							
								</tr>
							</thead>";
		foreach ($Entrenamientos as $key) {			
			  $Resultado .="<tbody>
								<tr style='text-transform: uppercase;'>
									<td>".$key->Lugar_Entrenamiento."</td>
									<td>".$key->Fecha_Inicio."</td>
									<td>".$key->Fecha_Fin."</td>
									<td>
										<button type='button' class='btn-sm btn-info' data-funcion='verEntrenamiento' value='".$key->Id."'>
	                                  		<span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span>
	                              		</button>
	                              		<button type='button' class='btn-sm btn-warning' data-funcion='entrenamientoDeportista' value='".$key->Id."'>
	                                  		<span class='glyphicon glyphicon-user' aria-hidden='true'></span>
	                              		</button>
	                              		<button type='button' class='btn-sm btn-primary' data-funcion='planillaAsistencia' value='".$key->Id."'>
	                                  		<span class='glyphicon glyphicon-check' aria-hidden='true'></span>
	                              		</button>
	                          		</td>
	                      		</tr>
	                  		</tbody>";		
		}
		$Resultado .= "</table>";
		return ($Resultado);
	}

	public function GetEntrenamientoOnly (Request $request, $id_entrenamiento){
		$Entrenamiento = Entrenamiento::find($id_entrenamiento);
		return $Entrenamiento;
	}

	public function ModificarEntrenamiento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
				"Entrenamiento_Id" => "required",
				"Lugar_EntrenamientoM" => "required",
				"FechaInicioM" => "required|date",
				"FechaFinM" => "required|date",
				"HoraInicioM" => "required",
				"HoraFinM" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Entrenamiento = Entrenamiento::find($request->Entrenamiento_Id);	
	        	$Entrenamiento ->Lugar_Entrenamiento = $request->Lugar_EntrenamientoM;
	        	$Entrenamiento ->Fecha_Inicio = $request->FechaInicioM;
	        	$Entrenamiento ->Fecha_Fin = $request->FechaFinM;
	        	$Entrenamiento ->Hora_Inicio = $request->HoraInicioM;
	        	$Entrenamiento ->Hora_Fin = $request->HoraFinM;


	        	if($Entrenamiento->save()){
	        		return response()->json(["Mensaje" => "Entrenamiento modificado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "El entrenamiento no ha sido modificado!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetEntrenadorDeportistasSINO(Request $request, $id_entrenador, $id_entrenamiento){
		$Resultado = '';

		$DeportistasVinculados = EntrenadorDeportista::with('deportista', 'deportista.persona', 'deportista.DeportistaEntrenamiento')->where('Entrenador_Id', $id_entrenador)
												    ->whereHas('deportista.DeportistaEntrenamiento', function ($query) use($id_entrenamiento){
    													$query->where('Entrenamiento_Id',$id_entrenamiento); })->get();


		/**********LISTADO DE DEPORTISTAS VINCULADOS AL ENTRENAMIENTO************/
		if(count($DeportistasVinculados) > 0){
		//	$Resultado .= '<h4>Listado de deportistas vinculados al entrenamiento</h4>';
			foreach ($DeportistasVinculados as $key) {			
				$Resultado .= '<div class="radio" style="text-transform: uppercase;"><label><input type="checkbox" checked="checked" name="deportista[]" id="';
				$Resultado .= $key['deportista']['Id'];
				$Resultado .= '" value="';
				$Resultado .= $key['deportista']['Id'];
				$Resultado .= '">';
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Primer_Nombre'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Segundo_Nombre'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Primer_Apellido'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Segundo_Apellido'];
				$Resultado .= '</label></div>';								
			}
		}

		/**********LISTADO DE DEPORTISTAS VINCULADOS AL ENTRENAMIENTO************/

		$ListaVinculados = $DeportistasVinculados->lists('deportista.Id');


		$EntrenadorDeportista = EntrenadorDeportista::with('deportista', 'deportista.persona', 'deportista.DeportistaEntrenamiento')->where('Entrenador_Id', $id_entrenador)->whereHas('deportista', function ($query) use($ListaVinculados){
    										$query->whereNotIn('Id',$ListaVinculados);
											})->get();

		if(count($EntrenadorDeportista) > 0){
		//	$Resultado .= '<h4>Listado de deportistas NO vinculados al entrenamiento</h4>';
			foreach ($EntrenadorDeportista as $key) {			
				$Resultado .= '<div class="radio" style="text-transform: uppercase;"><label><input type="checkbox" name="deportista[]" id="';
				$Resultado .= $key['deportista']['Id'];
				$Resultado .= '" value="';
				$Resultado .= $key['deportista']['Id'];
				$Resultado .= '">';
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Primer_Nombre'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Segundo_Nombre'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Primer_Apellido'];
				$Resultado .= ' ';
				$Resultado .= $key['deportista']['persona']['Segundo_Apellido'];
				$Resultado .= '</label></div>';								
			}
		}

		$Resultado .= '<br><div class="form-group col-md-12" align="center">
	                            <button data-funcion="AgregarDeportistasEntrenamiento" type="button" class="btn btn-primary ver" value="" name="AgregarDeportistasEntrenamiento" id="AgregarDeportistasEntrenamiento" >Vincular deportistas a entrenamiento</button>
	                        </div>';
		return ($Resultado);
	}

	public function AgregarDeportistaEntrenamiento(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
				"Entrenamiento_Id2" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaEntrenamiento = DeportistaEntrenamiento::where('Entrenamiento_Id', $request->Entrenamiento_Id2)->delete();

	        	if(count($request['deportista']) > 0){
	        		foreach ($request['deportista'] as $key => $value) {
	        		$DeportistaEntrenamientoN = new DeportistaEntrenamiento;
	        		$DeportistaEntrenamientoN->Deportista_Id = (integer)$value;
	        		$DeportistaEntrenamientoN->Entrenamiento_Id = $request->Entrenamiento_Id2;
	        		if(!$DeportistaEntrenamientoN->save()){
	        			return response()->json(["Estado" => "Error", "Mensaje" => "Se detuvo la vinculación de deportistas, recargue y revise la información de nuevo."]);			
	        		}
	        	}
        			return response()->json(["Estado" => "Success","Mensaje" => "La vinculación de los deportistas se realizó con éxito!"]);		
	        	}else{
	        		return response()->json(["Estado" => "Success","Mensaje" => "Se han desvinculado todos los deportistas con éxito!"]);	
	        	}	        			        		
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetEntrenamientoDeportistas(Request $request, $id_entrenamiento){
		$DeportistaEntrenamiento = DeportistaEntrenamiento::with('deportista.persona', 'deportistaAsistencia')->where('Entrenamiento_Id', $id_entrenamiento)->get();
		return $DeportistaEntrenamiento;
	}

	public function AgregarAsistencias (Request $request){
		foreach ($request->all() as $key => $value) {
			$valores = explode('-', $key);
			if(count($valores) > 1){
				$id = $valores[1];
				$Numero_Dia = $valores[2];
			}else{
				$id = 0;
				$Numero_Dia = 0;
			}

			if($id != null){
				$DeportistaEntrenamiento = DeportistaEntrenamiento::where('Deportista_Id', $id)->where('Entrenamiento_Id', $request->Asistencias)->get();
				$Entrenamiento = Entrenamiento::find($request->Asistencias);

				$date =  Carbon::parse($Entrenamiento->Fecha_Inicio);				 
				$fecha = $date->addDays($Numero_Dia-1);

				///Buscar si existe ya registro de la asistencia
				if($value != '' && $id > 0){
					$AsistenciaEntrenamiento = AsistenciaEntrenamiento::where('Deportista_Entrenamiento_Id', $DeportistaEntrenamiento[0]->Id)->where('Numero_Dia', $Numero_Dia)->get();
					if(count($AsistenciaEntrenamiento) > 0){					
						$AsistenciaEntrenamientoEdit = $AsistenciaEntrenamiento[0];
						$AsistenciaEntrenamientoEdit->Deportista_Entrenamiento_Id = $DeportistaEntrenamiento[0]->Id;
						$AsistenciaEntrenamientoEdit->Fecha = $fecha;
						$AsistenciaEntrenamientoEdit->Numero_Dia = $Numero_Dia;
						$AsistenciaEntrenamientoEdit->Convencion_Asistencia_Id = $value;
						$AsistenciaEntrenamientoEdit->save();
					}else{
						$AsistenciaEntrenamientoAdd = new AsistenciaEntrenamiento;
						$AsistenciaEntrenamientoAdd->Deportista_Entrenamiento_Id = $DeportistaEntrenamiento[0]->Id;
						$AsistenciaEntrenamientoAdd->Fecha = $fecha;
						$AsistenciaEntrenamientoAdd->Numero_Dia = $Numero_Dia;
						$AsistenciaEntrenamientoAdd->Convencion_Asistencia_Id = $value;
						$AsistenciaEntrenamientoAdd->save();
					}					
				}
			}
		}		
		return response()->json(["Estado" => "Success","Mensaje" => "La asistencia de  la planilla ha sido almacenada con éxito!"]);		
	}

	public function GetAsistenciaDeportistas(Request $request, $id_deportista, $id_entrenamiento, $numero_dia){
		$DeportistaEntrenamiento = DeportistaEntrenamiento::where('Deportista_Id', $id_deportista)->where('Entrenamiento_Id', $id_entrenamiento)->get();
		if(count($DeportistaEntrenamiento) > 0){
			$AsistenciaEntrenamiento = AsistenciaEntrenamiento::where('Deportista_Entrenamiento_Id', $DeportistaEntrenamiento[0]->Id)->where('Numero_Dia', $numero_dia)->get();
			if(count($AsistenciaEntrenamiento) > 0){
				return ($AsistenciaEntrenamiento[0]);
			}
		}
	}

	public function AgregarVerificacionRequisitos (Request $request){
		$Entrenamiento = Entrenamiento::find($request->Verificacion);
		foreach ($request->all() as $key => $value) {
			$valores = explode('-', $key);
			if(count($valores) > 1){
				$id = $valores[1];
				$Numero_Dia = $valores[2];
			}else{
				$id = 0;
				$Numero_Dia = 0;
			}
			if($id != null){
				$date =  Carbon::parse($Entrenamiento->Fecha_Inicio);				 
				$fecha = $date->addDays($Numero_Dia-1);

				$VerificacionEntrenamiento = VerificacionEntrenamiento::where('Entrenamiento_Id', $request->Verificacion)->where('Numero_Dia', $Numero_Dia)->get();	

				if(count($VerificacionEntrenamiento) > 0){
					$VerificacionEntrenamientoEdit = $VerificacionEntrenamiento[0];
					$VerificacionEntrenamientoEdit->Entrenamiento_Id = $Entrenamiento->Id;
					$VerificacionEntrenamientoEdit->Fecha = $fecha;
					$VerificacionEntrenamientoEdit->Numero_Dia = $Numero_Dia;
					if($id == 1){
						$VerificacionEntrenamientoEdit->P_1 = $value;
					}
					if($id == 2){
						$VerificacionEntrenamientoEdit->P_2 = $value;
					}
					if($id == 3){
						$VerificacionEntrenamientoEdit->P_3 = $value;
					}
					$VerificacionEntrenamientoEdit->save();
				}else{
						if($value != ''){
						$VerificacionEntrenamientoAdd = new VerificacionEntrenamiento;
						$VerificacionEntrenamientoAdd->Entrenamiento_Id = $Entrenamiento->Id;
						$VerificacionEntrenamientoAdd->Fecha = $fecha;
						$VerificacionEntrenamientoAdd->Numero_Dia = $Numero_Dia;
						if($id == 1){
							$VerificacionEntrenamientoAdd->P_1 = $value;
						}
						if($id == 2){
							$VerificacionEntrenamientoAdd->P_2 = $value;
						}
						if($id == 3){
							$VerificacionEntrenamientoAdd->P_3 = $value;
						}					
						$VerificacionEntrenamientoAdd->save();
					}
				}
			}
		}	
		return response()->json(["Estado" => "Success","Mensaje" => "La verificación de  la planilla ha sido almacenada con éxito!"]);		
	}

	public function GetEntrenamientoVerificaciones(Request $request, $id_entrenamiento){
		$VerificacionEntrenamiento = Entrenamiento::with('entrenamientoVerificacion')->find($id_entrenamiento);
		return($VerificacionEntrenamiento);
	}

	public function AgregarNoConformidad(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
				"Entrenamiento_Id5" => "required",
				"DescripcionNC" => "required",
				"FechaNC" => "date|required",
				"RequisitoNC" => "required",
				"TratamientoNC" => "required",
				"DescripcionAccionNC" => "required",
				"InconvenienteNC" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$EntrenamientoNoConformidad = new EntrenamientoNoConformidad;
	        	$EntrenamientoNoConformidad->Entrenamiento_Id = $request->Entrenamiento_Id5;
	        	$EntrenamientoNoConformidad->Tratamiento_Conformidad_Id = $request->TratamientoNC;
	        	$EntrenamientoNoConformidad->Fecha = $request->FechaNC;
	        	$EntrenamientoNoConformidad->Numero_Requisito = $request->RequisitoNC;
	        	$EntrenamientoNoConformidad->Descripcion_No_Conformidad = $request->DescripcionNC;
	        	$EntrenamientoNoConformidad->Descripcion_Accion = $request->DescripcionAccionNC;
	        	$EntrenamientoNoConformidad->Inconvenientes = $request->InconvenienteNC;

	        	if($EntrenamientoNoConformidad->save()){
	        		return response()->json(["Estado" => "Success","Mensaje" => "Se ha agregado la Inconformidad con éxito!"]);		
	        	}else{
	        		return response()->json(["Estado" => "Success","Mensaje" => "No se logro la adición de la inconformidad, por favor intentelo nuevamente"]);	
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetEntrenamientoNC(Request $request, $id_entrenamiento){
		$EntrenamientoNoConformidad = Entrenamiento::with('entrenamientoNoConformidad', 'entrenamientoNoConformidad.tratamientoConformidad')->find($id_entrenamiento);
		return $EntrenamientoNoConformidad;
	}

	public function EliminarNoConformidad(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
				"Id_No_Conformidad" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$EntrenamientoNoConformidad = EntrenamientoNoConformidad::find($request->Id_No_Conformidad);

	        	if($EntrenamientoNoConformidad->delete()){
	        		return response()->json(["Estado" => "Success","Mensaje" => "Se ha eliminado la Inconformidad con éxito!"]);		
	        	}else{
	        		return response()->json(["Estado" => "Success","Mensaje" => "No se logro la eliminación de la inconformidad, por favor intentelo nuevamente"]);	
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}
}
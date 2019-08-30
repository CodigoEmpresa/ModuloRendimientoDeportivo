<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Persona;
use App\Models\Tipo;
use App\Models\PersonaTipo;
use App\Models\ActividadesSim;
use App\Models\Agrupacion;

class AdministracionController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{		
		return view('ADMINISTRACION/persona_tipo');
	}

	public function PersonaTipo(Request $request, $id_persona){//Solo Tipos que NO esten vinculados a la persona
		$Persona = Persona::with('tipo')->find($id_persona);	
		$TipoLista = $Persona->tipo->lists('Id_Tipo');
		$Tipo = Tipo::where('Id_Modulo', '=', 28)->whereNotIn('Id_Tipo', $TipoLista)->get();
		return $Tipo;
	}

	public function AgregarPersonaTipo(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Id_Persona' => 'required',
    			'Tipo_Persona' => 'required',

    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$PersonaTipo = new PersonaTipo;
	        	$PersonaTipo->Id_Tipo = $request->Tipo_Persona;
	        	$PersonaTipo->Id_Persona = $request->Id_Persona;
	        	if($PersonaTipo->save()){
	        		return response()->json(["Mensaje" => "Tipo de persona agregado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "El tipo de persona no ha sido agregado!"]);			
	        	}	        	
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function PersonaTipo2(Request $request, $id_persona){//Solo Tipos que SI esten vinculados a la persona
		$Persona = Persona::with('tipo')->find($id_persona);			
		$Tipos = $Persona->tipo->where('Id_Modulo',28);
		return $Tipos;
	}

	public function EliminarPersonaTipo(Request $request, $id_persona, $id_tipo){
		$Persona = Persona::find($id_persona);
		if($Persona->Tipo()->detach($id_tipo)){
			return response()->json(["Mensaje" => "El tipo de persona ha sido eliminado con éxito!"]);			
		}else{
			return response()->json(["Mensaje" => "El tipo de persona no ha podido ser eliminado con éxito!"]);
		}
	}

	/********************************************************************************************************************/

	public function indexPermisos()
	{		
		return view('ADMINISTRACION/persona_permiso');
	}

	public function moduloActividades(){
    	$Actividades = ActividadesSim::join('modulo', 'actividades.Id_Modulo', '=', 'modulo.Id_Modulo')
					    	->where('actividades.Id_Modulo', '=', 28)
					    	->select('actividades.*')
					    	->get();
    	return $Actividades;
	}

	public function personaActividades(Request $request, $id){
		$personaActividades = Persona::with('Actividades')->find($id);
		$actividades = $personaActividades->Actividades()->where('Id_Modulo', 28)->where('Estado', 1)->get();
		return $actividades;
	}

	public function PersonasActividadesProceso(Request $request){
		$accesoPersona = Persona::with('acceso')->find($request->Id);
		$i=0;
		if(isset($accesoPersona->acceso)){
			$persona = Persona::find($request->Id);
			foreach ($request->Datos as $datos) {
				if($datos['estado'] == 1){
					$aprobadas[$datos['id_actividad']] = array('estado' =>  1);
					$eliminar[$i] = $datos['id_actividad'];
				}else{
					$aprobadas[$datos['id_actividad']] = array('estado' =>  0);
					$eliminar[$i] = $datos['id_actividad'];
				}
				$i++;
			
			}
			$persona->Actividades()->detach($eliminar);
			$persona->Actividades()->attach($aprobadas);
				$Mensaje = 'Las acticvidades de '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].' han sido asignadas correctamente.';
				$Bandera = 1;
		}else{
			$Mensaje = 'Para asignar actividades a '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].', primero debe contar con acceso al SIM.';
			$Bandera = 0;
		}		
		return response()->json(["Mensaje" => $Mensaje, "Bandera" => $Bandera]);
	}



	public function indexMetodologoAgrupacion(){
		$Personas = Tipo::with('personas', 'personas.deportista')->where('Id_Tipo', 58)->get();
		$Metodologos = $Personas[0]->personas;
		return view('ADMINISTRACION/metodologo_agrupacion')
			   ->with(compact('Metodologos'))
			   ;
	}

	public function getMetodologoAgrupacion(Request $request, $id_persona){
		$Persona = Persona::with('metodologoAgrupacion')->find($id_persona);
		$lista = $Persona->metodologoAgrupacion()->lists('agrupacion.Id');
		$Agrupacion = Agrupacion::with('ClasificacionDeportista')->whereIn('Id', $lista)->get();
		return $Agrupacion;
	}

	public function getMetodologoAgrupacionNO(Request $request, $id_persona){		
		$Persona = Persona::with('metodologoAgrupacion')->find($id_persona);
		$lista = $Persona->metodologoAgrupacion()->lists('agrupacion.Id');
		$Agrupacion = Agrupacion::with('ClasificacionDeportista')->whereNotIn('Id', $lista)->get();
		return $Agrupacion;
	}

	public function AgregarMetodologoAgrupacion(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Metodologo_Id' => 'required',
    			'Agrupacion_Id' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Persona = Persona::with('metodologoAgrupacion')->find($request->Metodologo_Id);
				$Persona->metodologoAgrupacion()->attach($request->Agrupacion_Id);
				return response()->json(["Mensaje" => 'Agrupación agregada con éxito a este metodólogo!']);
	        }
        }else{
        	return response()->json(["Sin acceso"]);
        }
	}

	public function EliminarMetodologoAgrupacion(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Metodologo_Id' => 'required',
    			'Agrupacion_Id' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Persona = Persona::with('metodologoAgrupacion')->find($request->Metodologo_Id);
				$Persona->metodologoAgrupacion()->detach($request->Agrupacion_Id);
				return response()->json(["Mensaje" => 'Agrupación eliminada con éxito para este metodólogo!']);
	        }
        }else{
        	return response()->json(["Sin acceso"]);
        }
    }

}
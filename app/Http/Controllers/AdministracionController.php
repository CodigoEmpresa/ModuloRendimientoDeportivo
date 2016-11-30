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
}
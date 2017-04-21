<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Test;
use App\Models\TipoTest;
use App\Models\VariableTest;
use App\Models\Persona;
use App\Models\Deportista;
use App\Models\DeportistaTest;

class GestorTestController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){
    	$TipoTest = TipoTest::all();
		return view('TECNICO/gestorTest')
			 ->with(compact('TipoTest'))
		;
	}

	public function GetTest(Request $request){
		$Test = Test::with('tipoTest')->get();
		return $Test;
	}

	public function AgregarTest(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Tipo_Test" => "required",
  				"Nombre_Test" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Test = new Test;
	        	$Test->Tipo_Test_Id = $request->Tipo_Test;
	        	$Test->Nombre_Test = $request->Nombre_Test;

	        	if($Test->save()){
	        		return response()->json(["Mensaje" => "El Test ha sido agregado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro el almacenamiento, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function EliminarTest(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Id_Test" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Test = Test::find($request->Id_Test);
	        	if($Test->delete()){
	        		return response()->json(["Mensaje" => "El Test ha sido eliminado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro la eliminación, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function AgregarVariable(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Unidad_Medicion" => "required",
  				"Nombre_Variable" => "required"
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$VariableTest = new VariableTest;
	        	$VariableTest->Unidad_Medicion = $request->Unidad_Medicion;
	        	$VariableTest->Nombre_Variable = $request->Nombre_Variable;	        

	        	if($VariableTest->save()){
	        		return response()->json(["Mensaje" => "La variable ha sido agregada con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro el almacenamiento, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}	

	public function GetVariables(Request $request){
		$VariableTest = VariableTest::all();
		return $VariableTest;
	}

	public function EliminarVariable(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Id_Variable" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$VariableTest = VariableTest::find($request->Id_Variable);
	        	if($VariableTest->delete()){
	        		return response()->json(["Mensaje" => "La variable ha sido eliminado con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro la eliminación, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}



	public function indexAsignacion(){
		$Persona = Persona::with('entrenador', 'entrenador.entrenadorDeportista.persona')->find($_SESSION['Usuario'][0]);
		$TipoTest = TipoTest::all();
		$VariableTest = VariableTest::all();
		return view('TECNICO/asignacionTestDeportista')
			 ->with(compact('Persona'))
			 ->with(compact('TipoTest'))
			 ->with(compact('VariableTest'))
		;
	}

	public function GetDeportista(Request $request, $id_deportista){
		$Deportista = Deportista::with('persona')->find($id_deportista);
		return $Deportista;
	}

	public function AgregarAsignacionTestDeportista(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Tipo_Test_Id" => "required",
				"Test_Id" => "required",
				"Variable_Id" => "required",
				"Resultado" => "required",
				"Descripcion" => "required",
				"Deportista_Id" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaTest = new DeportistaTest;
	        	$DeportistaTest->Deportista_Id = $request->Deportista_Id;
	        	$DeportistaTest->Test_Id = $request->Test_Id;
	        	$DeportistaTest->Variable_Test_Id = $request->Variable_Id;
	        	$DeportistaTest->Resultado = $request->Resultado;
	        	$DeportistaTest->Descripcion_Resultado = $request->Descripcion;

	        	if($DeportistaTest->save()){
	        		return response()->json(["Mensaje" => "Se ha asignado el test al deportista con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro el la asignación del test, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function GetTestTipos(Request $request, $id_tipo_test){
		$Test = Test::where('Tipo_Test_Id', $id_tipo_test)->get();
		return $Test;
	}

	public function GetTestDeportista(Request $request, $id_deportista){
		$Deportista = Deportista::with('deportistaTest', 'deportistaTest.variableTest', 'deportistaTest.test', 'deportistaTest.test.tipoTest')->find($id_deportista);
		return $Deportista;
	}

	public function EliminarAsignacionTestDeportista(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [    			
				"Id_DeportistaTes_Delete" => "required",
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaTest = DeportistaTest::find($request->Id_DeportistaTes_Delete);

	        	if($DeportistaTest->delete()){
	        		return response()->json(["Mensaje" => "Se ha eliminado el test de este deportista con éxito!"]);				        		
	        	}else{
	        		return response()->json(["Mensaje" => "No se logro el la eliminación del test, por favor inténtelo nuevamente!"]);			
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}
}
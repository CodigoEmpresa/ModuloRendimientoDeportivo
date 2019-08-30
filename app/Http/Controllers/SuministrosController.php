<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\TipoComplemento;
use App\Models\Complemento;
use App\Models\DeportistaComplemento;
use App\Models\Deportista;
use App\Models\Apoyo;
use App\Models\DeportistaApoyo;
use App\Models\TipoAlimentacion;
use App\Models\DeportistaAlimentacion;
use App\Models\Alimentacion;

class SuministrosController extends Controller{
	
     public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){
		$TipoComplemento = TipoComplemento::all();
		$Complemento = Complemento::all();
		$Apoyo = Apoyo::all();
		$TipoAlimentacion = TipoAlimentacion::all();

		return view('SIAB/suministros')
		->with(compact('TipoComplemento'))
		->with(compact('Complemento'))
		->with(compact('Apoyo'))
		->with(compact('TipoAlimentacion'))
		;
	}

	public function RegistrarComplemento(Request $request){
		if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), [
    			'TipoComplemento' => 'required',
    			'Complemento' => 'required',
    			'PrecioOtro' => array('required_if:Complemento,25'),
    			'Cantidad' => 'required|numeric',
    			'FechaComplemento' => 'required|date'
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaComplemento = new DeportistaComplemento;
	        	$DeportistaComplemento->Deportista_Id = $request->deportista1;
	        	$DeportistaComplemento->Complemento_Id = $request->Complemento;
	        	$DeportistaComplemento->Cantidad = $request->Cantidad;
	        	if($request->Complemento == 25){
	        		$DeportistaComplemento->Valor = $request->PrecioOtro;
	        	}else{
	        		$DeportistaComplemento->Valor = $request->ValorComplemento;
	        	}
	        	$DeportistaComplemento->Fecha = $request->FechaComplemento ;

	        	if($DeportistaComplemento->save()){
	        		return response()->json(["Mensaje" => "Complemento registrado con éxito!"]);				
	        	}else{
	        		return response()->json(["Mensaje" => "No fue exitoso!"]);			
	        	}				
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function Complemento_Datos(Request $request, $id){
		if ($request->ajax()) { 
	    	$Complemento = TipoComplemento::with('complemento')->find($id);
	    	return($Complemento);
	    }
	}

	public function ValorComplemento_Datos(Request $request, $id){
		if ($request->ajax()) { 
	    	$ValorComplemento = Complemento::find($id);
	    	return($ValorComplemento);
	    }
	}

	public function Lista_Complemento_Datos(Request $request, $id){
		if ($request->ajax()) { 
			$Complemento = Deportista::with('deportistaComplemento')->find($id);
			return($Complemento);	    
	    }
	}

	public function Lista_Apoyos_Datos(Request $request, $id){
		if ($request->ajax()) { 
			$Apoyos = Deportista::with('deportistaApoyo')->find($id);
			return($Apoyos);	    
	    }
	}

	public function RegistrarApoyo(Request $request){
		if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), [
    			'TipoApoyo' => 'required',
    			'ValorApoyo' => 'required|numeric',
    			'FechaApoyo' => 'required|date',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaApoyo = new DeportistaApoyo;
	        	$DeportistaApoyo->Deportista_Id = $request->deportista3;
	        	$DeportistaApoyo->Apoyo_Id = $request->TipoApoyo;
	        	$DeportistaApoyo->Valor = $request->ValorApoyo;
	        	$DeportistaApoyo->Fecha = $request->FechaApoyo;

	        	if($DeportistaApoyo->save()){
	        		return response()->json(["Mensaje" => "Apoyo registrado con éxito!"]);				
	        	}else{
	        		return response()->json(["Mensaje" => "No fue exitoso!"]);			
	        	}				
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}

	public function Lista_Alimentacion_Datos(Request $request, $id){
		if ($request->ajax()) { 
			$Alimentacion = Deportista::with('deportistaAlimentacion', 'deportistaAlimentacion.TipoAlimentacion')->find($id);
			return($Alimentacion);	    
	    }
	}

	public function Alimentacion_Datos(Request $request, $id){
		if ($request->ajax()) { 
	    	$Alimentacion = TipoAlimentacion::with('alimentacion')->find($id);
	    	return($Alimentacion);
	    }
	}

	public function ValorAlimentacion_Datos(Request $request, $id){
		if ($request->ajax()) { 
	    	$ValorAlimentacion = Alimentacion::find($id);
	    	return($ValorAlimentacion);
	    }
	}

	public function RegistrarAlimentacion(Request $request){
		if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), [
    			'TipoAlimentacion' => 'required',
    			'Alimentacion' => 'required',
    			'CantidadAlimentacion' => 'required|numeric',
    			'FechaAlimentacion' => 'required|date',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$DeportistaAlimentacion = new DeportistaAlimentacion;
	        	$DeportistaAlimentacion->Deportista_Id = $request->deportista2;
	        	$DeportistaAlimentacion->Alimentacion_Id = $request->Alimentacion;
	        	$DeportistaAlimentacion->Cantidad = $request->CantidadAlimentacion;
	        	$DeportistaAlimentacion->Valor = $request->ValorAlimentacion;
	        	$DeportistaAlimentacion->Fecha = $request->FechaAlimentacion;

	        	if($DeportistaAlimentacion->save()){
	        		return response()->json(["Mensaje" => "Alimentación registrada con éxito!"]);				
	        	}else{
	        		return response()->json(["Mensaje" => "No fue exitoso!"]);			
	        	}				
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
	}
}
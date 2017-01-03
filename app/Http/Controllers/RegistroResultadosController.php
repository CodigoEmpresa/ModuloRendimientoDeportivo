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
use App\Models\ClasificacionDeportista;
use App\Models\Evento;
use App\Models\Certamen;
use App\Models\CertamenDivision;
use App\Models\CertamenDivisionMetodologo;
use App\Models\Departamento;
use App\Models\CertamenDivisionResultado;
use App\Models\ResultadoExterno;
use App\Models\Agrupacion;
use App\Models\Division;

class RegistroResultadosController extends Controller
{
	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function AsignacionPruebasDeportivas(){
    	$Tipo = Tipo::with('personas')->where('Id_Modulo', 28)->where('Id_Tipo', 58)->get();
    	$Personas = $Tipo[0]['personas'];
    	$ClasificacionDeportista = ClasificacionDeportista::all();
    	return view('TECNICO/asignarPruebas')
			    	->with(compact('Personas'))
			    	->with(compact('ClasificacionDeportista'))
			    	;
    }

    public function GetEventosClasfificacion(Request $request, $id){
    	$Eventos = Evento::where('Clasificacion_Deportista_Id', $id)->get();
    	return $Eventos;
    }

    public function GetCertamenEventos(Request $request, $id){
    	$Certamen = Certamen::where('Evento_Id', $id)->get();
    	return $Certamen;
    }

    public function GetDivisionCertamenMetod(Request $request, $id_certamen, $id_metodologo){//Certamenes NO INSCRITOS AL METODOLOGO

    	$Persona = Persona::with('metodologoAgrupacion')->find($id_metodologo);
		$lista = $Persona->metodologoAgrupacion()->lists('agrupacion.Id');

		$Division = Division::whereIn('Agrupacion_Id', $lista)->lists('Id');

    	$cerDiv = CertamenDivision::where('Certamen_Id', $id_certamen)->lists('Id');

		$DivisionMetodologo = CertamenDivisionMetodologo::whereIn('CertamenDivision_Id', $cerDiv)->lists('CertamenDivision_Id');	

	 	$CertamenDivision = CertamenDivision::with('division', 'division.Deporte', 'division.rama', 'division.categoria', 'division.agrupacion')->
    							  whereNotIn('Id', $DivisionMetodologo)->
    							  where('Certamen_Id', $id_certamen)->
    							  whereIn('Division_Id', $Division)->
    							  get();
	  	return $CertamenDivision;
	}

	public function GetDivisionCertamenMetodS(Request $request, $id_certamen, $id_metodologo){//Certamenes INSCRITOS AL METODOLOGO

		$cerDiv = CertamenDivision::with('division', 'division.Deporte', 'division.rama', 'division.categoria')
    							  ->where('Certamen_Id', $id_certamen)->lists('Id');

		$DivisionMetodologo = CertamenDivisionMetodologo::with('cetamenDivision','cetamenDivision.division', 'cetamenDivision.division.Deporte', 'cetamenDivision.division.rama', 'cetamenDivision.division.categoria')->
														  whereIn('CertamenDivision_Id', $cerDiv)->
														  where('Persona_Id', $id_metodologo)->
														  get();
	  	return $DivisionMetodologo;

		

	}

	public function AgregarCertamenDivisionMetodologo(Request $request, $id_certamenDivision, $id_metodologo){
		$CertamenDivisionMetodologo =  new CertamenDivisionMetodologo;
		$CertamenDivisionMetodologo->CertamenDivision_Id = $id_certamenDivision;
		$CertamenDivisionMetodologo->Persona_Id = $id_metodologo;

		if($CertamenDivisionMetodologo->save()){
			return response()->json(["Mensaje" => "Prueba agregada con éxito!", "Bandera" => 1]);				        		
		}else{
			return response()->json(["Mensaje" => "No se ha logrado agregar la prueba a este metodologo!", "Bandera" => 2]);				        		
		}
	}

	public function DenegacionPruebasDeportivas(){
    	$Tipo = Tipo::with('personas')->where('Id_Modulo', 28)->where('Id_Tipo', 58)->get();
    	$Personas = $Tipo[0]['personas'];
    	$ClasificacionDeportista = ClasificacionDeportista::all();
    	return view('TECNICO/denegarPruebas')
			    	->with(compact('Personas'))
			    	->with(compact('ClasificacionDeportista'))
			    	;
    }

    public function EliminarCertamenDivisionMetodologo(Request $request, $id_certamenDivision, $id_metodologo){
    	$CertamenDivisionMetodologo =  CertamenDivisionMetodologo::where('CertamenDivision_Id', $id_certamenDivision)->where('Persona_Id', $id_metodologo)->get();
    	$CertamenDivisionMetodologo2 = CertamenDivisionMetodologo::find($CertamenDivisionMetodologo[0]['Id']);    	

    	if($CertamenDivisionMetodologo2->delete()){
			return response()->json(["Mensaje" => "Prueba eliminada con éxito!", "Bandera" => 1]);				        		
		}else{
			return response()->json(["Mensaje" => "No se ha logrado eliminar la prueba a este metodologo!", "Bandera" => 2]);				        		
		}
    }


    public function RegistroResultadosDeportivos(){
    	$ClasificacionDeportista = ClasificacionDeportista::all();
    	$Ciudad = Departamento::all();
    	$Usuario = $_SESSION['Usuario'];
    	return view('TECNICO/registroResultados')
			    	->with(compact('ClasificacionDeportista'))
			    	->with(compact('Ciudad'))
			    	->with(compact('Usuario'))
			    	;
    }

    public function AgregarRegistroDeportista(Request $request){
    	if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'CertamenDivision' => 'required',
    			'OroDeportista' => array('required_if:Puesto,1'),
    			'OroMarca' => array('required_if:Puesto,1'),
    			'OroCiudad' => array('required_if:Puesto,1'),
    			'PlataDeportista' => array('required_if:Puesto,2'),
    			'PlataMarca' => array('required_if:Puesto,2'),
    			'PlataCiudad' => array('required_if:Puesto,2'),
    			'BronceDeportista' => array('required_if:Puesto,3'),
    			'BronceMarca' => array('required_if:Puesto,3'),
    			'BronceCiudad' => array('required_if:Puesto,3'),
    			'TresDeportista' => array('required_if:Puesto,4'),
    			'TresMarca' => array('required_if:Puesto,4'),
    			'TresCiudad' => array('required_if:Puesto,4'),
    			'TresPuesto' => array('required_if:Puesto,4', 'numeric', 'min:4'),
    			'Puesto' => 'required',
    			]);
	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{

	        	$CertamenDivisionResultado = new CertamenDivisionResultado;
	        	$Departamento = '';
	        	if($request->Puesto == 1){		        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->OroCiudad;
		        	$CertamenDivisionResultado->Deportista_Id = $request->OroDeportista;
		        	$CertamenDivisionResultado->Marca = $request->OroMarca;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;	
		        	if($request->OroCiudad == 33){ $Departamento = 'Bogota D.C';}

		        }
		        if($request->Puesto == 2){		        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->PlataCiudad;
		        	$CertamenDivisionResultado->Deportista_Id = $request->PlataDeportista;
		        	$CertamenDivisionResultado->Marca = $request->PlataMarca;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;		
		        	if($request->PlataCiudad == 33){ $Departamento = 'Bogota D.C';}
		        }
		        if($request->Puesto == 3){		        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->BronceCiudad;
		        	$CertamenDivisionResultado->Deportista_Id = $request->BronceDeportista;
		        	$CertamenDivisionResultado->Marca = $request->BronceMarca;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;	
		        	if($request->BronceCiudad == 33){ $Departamento = 'Bogota D.C';}
		        	        		        	
		        }

		        if($request->Puesto == 4){		        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->TresCiudad;
		        	$CertamenDivisionResultado->Deportista_Id = $request->TresDeportista;
		        	$CertamenDivisionResultado->Marca = $request->TresMarca;
		        	$CertamenDivisionResultado->Puesto = $request->TresPuesto;	
		        	if($request->TresCiudad == 33){ $Departamento = 'Bogota D.C';}
		        	        		        	
		        }		        

		        if($CertamenDivisionResultado->save()){
		        	$datos = CertamenDivisionResultado::with('resultadoExterno', 'deportista', 'deportista.persona')->find($CertamenDivisionResultado['Id']);
		        	$Nombres =  $datos->deportista->persona['Primer_Nombre'].' '.$datos->deportista->persona['Segundo_Nombre'].' '.$datos->deportista->persona['Primer_Apellido'].' '.$datos->deportista->persona['Segundo_Apellido'];
		        	$Marca = $datos['Marca'];
		        	$Id_c = $CertamenDivisionResultado['Id'];
	        		return response()->json(["Mensaje" => "Se ha realizado el registro de este resultado de forma exitosa", "Nombres" => $Nombres, "Ciudad" => $Departamento, "Marca" => $Marca, "Id" => $Id_c, 'Puesto' => $request->TresPuesto ]);
	        	}else{
	        		return response()->json(["Mensaje" => "No se ha logrado el registro, por favor intentelo nuevamente!"]);				        		  	
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
    }

    public function AgregarRegistroDeportistaN(Request $request){
    	if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'OroDeportistaN' => array('required_if:Puesto,1'),
    			'OroMarcaN' => array('required_if:Puesto,1'),
    			'OroCiudad' => array('required_if:Puesto,1'),
    			'PlataDeportistaN' => array('required_if:Puesto,2'),
    			'PlataMarcaN' => array('required_if:Puesto,2'),
    			'PlataCiudad' => array('required_if:Puesto,2'),
    			'BronceDeportistaN' => array('required_if:Puesto,3'),
    			'BronceMarcaN' => array('required_if:Puesto,3'),
    			'BronceCiudad' => array('required_if:Puesto,3'),
    			'TresDeportistaN' => array('required_if:Puesto,4'),
    			'TresMarcaN' => array('required_if:Puesto,4'),
    			'TresCiudad' => array('required_if:Puesto,4'),
    			'TresPuestoN' => array('required_if:Puesto,4', 'numeric', 'min:4'),
    			'Puesto' => 'required',
    			]);
	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$CertamenDivisionResultado = new CertamenDivisionResultado;
	        	
	        	if($request->Puesto == 1){		  
	        		$Ciudad = $request->OroCiudad;
	        		$Marca = $request->OroMarcaN;
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->OroCiudad;
		        	$CertamenDivisionResultado->Marca = $request->OroMarcaN;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;		     
		        }
		        if($request->Puesto == 2){	
		        	$Ciudad = $request->PlataCiudad;
	        		$Marca = $request->PlataMarcaN;	        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->PlataCiudad;
		        	$CertamenDivisionResultado->Marca = $request->PlataMarcaN;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;		   
		        }
		        if($request->Puesto == 3){		        
		        	$Ciudad = $request->BronceCiudad;
	        		$Marca = $request->BronceMarcaN;	        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->BronceCiudad;
		        	$CertamenDivisionResultado->Marca = $request->BronceMarcaN;
		        	$CertamenDivisionResultado->Puesto = $request->Puesto;		
		        }

		        if($request->Puesto == 4){		        
		        	$Ciudad = $request->TresCiudad;
	        		$Marca = $request->TresMarcaN;	        	
		        	$CertamenDivisionResultado->CertamenDivision_Id = $request->CertamenDivision;
		        	$CertamenDivisionResultado->Departamento_Id = $request->TresCiudad;
		        	$CertamenDivisionResultado->Marca = $request->TresMarcaN;
		        	$CertamenDivisionResultado->Puesto = $request->TresPuestoN;
		        }

		        $Departamento = Departamento::find($Ciudad);
		        if($Departamento == null){
		        	if($Ciudad == 34){ $DepartamentoD = 'Fuerzas Armadas';}
		        	if($Ciudad == 35){ $DepartamentoD = 'Internacional';}
		        }else{
		        	$DepartamentoD = $Departamento['Nombre_Departamento'];
		        }

		        	

		        if($CertamenDivisionResultado->save()){

		        	$Ultimo = $CertamenDivisionResultado->Id;

		        	$ResultadoExterno = new ResultadoExterno;
		        	if($request->Puesto == 1){
		        		$Nombres = $request->OroDeportistaN;
		        		$ResultadoExterno->Nombres = $request->OroDeportistaN;
		        	}
			        if($request->Puesto == 2){		 
			        	$Nombres = $request->PlataDeportistaN;	       	
			        	$ResultadoExterno->Nombres = $request->PlataDeportistaN;     	
			        }
			        if($request->Puesto == 3){		
			        	$Nombres = $request->BronceDeportistaN;        	
			        	$ResultadoExterno->Nombres = $request->BronceDeportistaN;
			        }
			        if($request->Puesto == 4){		
			        	$Nombres = $request->TresDeportistaN;        	
			        	$ResultadoExterno->Nombres = $request->TresDeportistaN;
			        }
			        	
		        	$ResultadoExterno->CertamenDivisionResultado_Id = $Ultimo;

		        	if($ResultadoExterno->save()){
	        			return response()->json(["Mensaje" => "Se ha realizado el registro de este resultado de forma exitosa", "Nombres" => $Nombres, "Ciudad" => $DepartamentoD, "Marca" => $Marca, "Id" => $Ultimo,  'Puesto' => $request->TresPuestoN ]);				        		  	
	        		}else{
	        			return response()->json(["Mensaje" => "No se ha logrado el registro, por favor intentelo nuevamente!"]);				        		  	
	        		}
	        	}else{
	        		return response()->json(["Mensaje" => "No se ha logrado el registro, por favor intentelo nuevamente!"]);				        		  	
	        	}
			}
		}else{
			return response()->json(["Sin acceso"]);
		}
    }

    public function GetCertamenDivisionResultados(Request $request, $id_certamenDivision){    	
    	$CertamenDivisionResultado = CertamenDivisionResultado::with('resultadoExterno', 'deportista', 'deportista.persona', 'departamento')->where('CertamenDivision_Id', $id_certamenDivision)->get();
    	return $CertamenDivisionResultado;
    }

    public function EliminarCertamenDivisionRegistro(Request $request, $id_certamenDivisionResultado){
    	$CertamenDivisionResultado = CertamenDivisionResultado::with('resultadoExterno')->find($id_certamenDivisionResultado);    	
    	if(count($CertamenDivisionResultado->resultadoExterno) > 0){
    		$ResultadoExterno = ResultadoExterno::find($CertamenDivisionResultado->resultadoExterno[0]['Id']);
    		if($ResultadoExterno->delete()){
    			if($CertamenDivisionResultado->delete()){
    				return response()->json(["Mensaje" => "Se ha eliminado este resultado de forma exitosa"]);				        		  	
    			}else{
    				return response()->json(["Mensaje" => "No se ha logrado eliminar el resultado de forma exitosa"]);				        		  	
    			}
    		}
    	}else{
    		if($CertamenDivisionResultado->delete()){
				return response()->json(["Mensaje" => "Se ha eliminado este resultado de forma exitosa"]);				        		  	
			}else{
				return response()->json(["Mensaje" => "No se ha logrado eliminar el resultado de forma exitosa"]);				        		  	
			}
    	}
    }
}

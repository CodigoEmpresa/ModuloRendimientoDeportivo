<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroEntrenador;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Ciudad;
use App\Models\ClasificacionDeportista;
use App\Models\Departamento;
use App\Models\GrupoSanguineo;
use App\Models\Localidad;
use App\Models\NivelRegimenSub;
use App\Models\Parentesco;
use App\Models\RegimenSalud;
use App\Models\Talla;
use App\Models\TipoAfiliacion;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Genero;
use App\Models\TipoTalla;
use App\Models\Arl;
use App\Models\FondoPension;
use App\Models\Agrupacion;
use App\Models\Deporte;
use App\Models\DeportistaDeporte;
use App\Models\PersonaTipo;

use App\Models\Entrenador;

class EntrenadorController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		$Ciudad = Ciudad::all();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$Departamento = Departamento::all();
		$GrupoSanguineo = GrupoSanguineo::all();
		$Localidad = Localidad::all();
		$NivelRegimenSub = NivelRegimenSub::all();
		$Parentesco = Parentesco::all();
		$RegimenSalud = RegimenSalud::all();
		$TipoAfiliacion = TipoAfiliacion::all();
		$Eps = Eps::all();
		$deportista = array();
		$Pais = Pais::all();
		$Genero = Genero::all();
		$Arl = Arl::all();
		$FondoPension = FondoPension::all();

		return view('TECNICO/entrenador',['deportista' => $deportista])
		->with(compact('Ciudad'))
		->with(compact('ClasificacionDeportista'))
		->with(compact('Departamento'))
		->with(compact('Localidad'))
		->with(compact('GrupoSanguineo'))
		->with(compact('NivelRegimenSub'))
		->with(compact('Parentesco'))
		->with(compact('RegimenSalud'))
		->with(compact('TipoAfiliacion'))
		->with(compact('Eps'))
		->with(compact('Pais'))
		->with(compact('Genero'))		
		->with(compact('Arl'))		
		->with(compact('FondoPension'))	
		;
	}

	public function BuscarTipoPersona(Request $request, $cedula){
		if ($request->ajax()) {

			$Persona = Persona:: with('tipo')->where('Cedula', $cedula)->get();

			if(count($Persona) != 0){
				foreach ($Persona[0]->tipo as $key => $tipo) {
					if($tipo['Id_Tipo'] == 47 || $tipo['Id_Tipo'] == 49){
						return response()->json(["Respuesta" => '1', "Mensaje" => "Esta persona ya se encuentra registrada como un deportista, por favor verifique la información!."]);
					}else {
						return response()->json(["Respuesta" => '2']);
					}
				}
			}else{
				return response()->json(["Respuesta" => '1', "Mensaje" => "No se encuentra ninguna persona registrada con estos datos."]);

			}
		}
	}

	public function datosEntrenador($id){
        $persona = Persona::with('entrenador'
        					)->find($id);
        return $persona;
    }


    public function RegistrarEntrenador(RegistroEntrenador $request){ 
    	//dd($request->all());
    	
    	if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Entrenador = new Entrenador;
	        	$Entrenador->Persona_Id = $request->persona;
	    		$Entrenador->Lugar_Expedicion_Id = $request->LugarExpedicion;
	    		$Entrenador->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
	    		$Entrenador->Agrupacion_Id = $request->Agrupacion;
	    		$Entrenador->Deporte_Id = $request->Deporte;
	    		$Entrenador->Modalidad_Id = $request->Modalidad;
	    		$Entrenador->Departamento_Id_Nac = $request->DepartamentoNac;
	    		$Entrenador->Parentesco_Id = $request->Parentesco;
	    		$Entrenador->Departamento_Id_Localiza = $request->DepartamentoLoc;
	    		$Entrenador->Ciudad_Id_Localiza = $request->MunicipioLoc;
	    		$Entrenador->Localidad_Id_Localiza = $request->Localidad;
	    		$Entrenador->Regimen_Salud_Id = $request->Regimen;
	    		$Entrenador->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
	    		$Entrenador->Nivel_Regimen_Sub_Id = $request->NivelRegimen;
	    		$Entrenador->Eps_Id = $request->Eps;
	    		$Entrenador->Sudadera_Talla_Id = $request->Sudadera;
	    		$Entrenador->Camiseta_Talla_Id = $request->Camiseta;
	    		$Entrenador->Pantaloneta_Talla_Id = $request->Pantaloneta;
	    		$Entrenador->Tenis_Talla_Id = $request->Tenis;
	    		$Entrenador->Grupo_Sanguineo_Id = $request->GrupoSanguineo;
	    		$Entrenador->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
	    		$Entrenador->Fondo_Pension_Id = $request->FondoPension;
	    		$Entrenador->Fecha_Expedicion = $request->FechaExpedicion;
	    		$Entrenador->Numero_Pasaporte = $request->Pasaporte;
			 	$Entrenador->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
			 	$Entrenador->Libreta_Preg = $request->LibretaPreg;
			 	$Entrenador->Numero_Libreta_Mil = $request->Libreta;
			 	$Entrenador->Distrito_Libreta_Mil = $request->Distrito;
			 	$Entrenador->Nombre_Contacto = $request->NombreContacto;
			 	$Entrenador->Fijo_Contacto = $request->FijoContacto;
			 	$Entrenador->Celular_Contacto = $request->CelularContacto;
			 	$Entrenador->Barrio_Localiza = $request->Barrio;
			 	$Entrenador->Direccion_Localiza = $request->Direccion;
			 	$Entrenador->Fijo_Localiza = $request->FijoLoc;
			 	$Entrenador->Celular_Localiza = $request->CelularLoc;
			 	$Entrenador->Correo_Electronico = $request->Correo;			 	
			 	$Entrenador->Fecha_Afiliacion = $request->FechaAfiliacion;
			 	$Entrenador->Medicina_Prepago = $request->MedicinaPrepago;
			 	$Entrenador->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
			 	$Entrenador->Riesgo_Laboral = $request->RiesgosLaborales;
			 	$Entrenador->Uso_Medicamento = $request->Medicamento;
			 	$Entrenador->Medicamento = $request->CualMedicamento;
			 	$Entrenador->Tiempo_Medicamento = $request->TiempoMedicamento;
			 	$Entrenador->Otro_Medico_Preg = $request->OtroMedicoPreg;	
			 	$Entrenador->Otro_Medico = $request->OtroMedico;			 	
			 	$Entrenador->Arl_Id = $request->Arl;

			 	$Entrenador->Profesional_Preg = $request->Profesional;
	            $Entrenador->Titulo_Pregrado = $request->TituloPregrado;
	            $Entrenador->Titulo_Especializacion = $request->TituloEspecializacion;
	            $Entrenador->Titulo_Maestria = $request->TituloMaestria;
	            $Entrenador->Titulo_Doctorado = $request->TituloDoctorado;
	            $Entrenador->Curso_Entrenadores = $request->EscalafonEntrenadores;

			 	if(isset($request->FotografiaDep)){
				 	$file1=$request->file('FotografiaDep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
		            $file1->move(public_path().'/Img/EntrenadorFotografias/', $Nom_imagen1);
		            $Entrenador->Archivo1_Url = $Nom_imagen1;
		        }else{
		        	$Entrenador->Archivo1_Url = '';
		        }
		        if($Entrenador->save()){
		        	$PersonaTipo = new PersonaTipo;
			 		$PersonaTipo->Id_Tipo = 59;
			 		$PersonaTipo->Id_Persona = $request->persona;
			 		$PersonaTipo->save();

		        	return response()->json(["Mensaje" => "Entrenador registrado con éxito."]);                	
			 	}else{
			 		return response()->json(["Mensaje" => "Se presento una falla, intentelo de nuevo."]);                	
			 	}	        
	        }    		
    	}
    }

     public function ModificarEntrenador(RegistroEntrenador $request){     	
    	if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$Entrenador = Entrenador::find($request->entrenador);
	        	$Entrenador->Persona_Id = $request->persona;
	    		$Entrenador->Lugar_Expedicion_Id = $request->LugarExpedicion;
	    		$Entrenador->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
	    		$Entrenador->Agrupacion_Id = $request->Agrupacion;
	    		$Entrenador->Deporte_Id = $request->Deporte;
	    		$Entrenador->Modalidad_Id = $request->Modalidad;
	    		$Entrenador->Departamento_Id_Nac = $request->DepartamentoNac;
	    		$Entrenador->Parentesco_Id = $request->Parentesco;
	    		$Entrenador->Departamento_Id_Localiza = $request->DepartamentoLoc;
	    		$Entrenador->Ciudad_Id_Localiza = $request->MunicipioLoc;
	    		$Entrenador->Localidad_Id_Localiza = $request->Localidad;
	    		$Entrenador->Regimen_Salud_Id = $request->Regimen;
	    		$Entrenador->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
	    		$Entrenador->Nivel_Regimen_Sub_Id = $request->NivelRegimen;
	    		$Entrenador->Eps_Id = $request->Eps;
	    		$Entrenador->Sudadera_Talla_Id = $request->Sudadera;
	    		$Entrenador->Camiseta_Talla_Id = $request->Camiseta;
	    		$Entrenador->Pantaloneta_Talla_Id = $request->Pantaloneta;
	    		$Entrenador->Tenis_Talla_Id = $request->Tenis;
	    		$Entrenador->Grupo_Sanguineo_Id = $request->GrupoSanguineo;
	    		$Entrenador->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
	    		$Entrenador->Fondo_Pension_Id = $request->FondoPension;
	    		$Entrenador->Fecha_Expedicion = $request->FechaExpedicion;
	    		$Entrenador->Numero_Pasaporte = $request->Pasaporte;
			 	$Entrenador->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
			 	$Entrenador->Libreta_Preg = $request->LibretaPreg;
			 	$Entrenador->Numero_Libreta_Mil = $request->Libreta;
			 	$Entrenador->Distrito_Libreta_Mil = $request->Distrito;
			 	$Entrenador->Nombre_Contacto = $request->NombreContacto;
			 	$Entrenador->Fijo_Contacto = $request->FijoContacto;
			 	$Entrenador->Celular_Contacto = $request->CelularContacto;
			 	$Entrenador->Barrio_Localiza = $request->Barrio;
			 	$Entrenador->Direccion_Localiza = $request->Direccion;
			 	$Entrenador->Fijo_Localiza = $request->FijoLoc;
			 	$Entrenador->Celular_Localiza = $request->CelularLoc;
			 	$Entrenador->Correo_Electronico = $request->Correo;			 	
			 	$Entrenador->Fecha_Afiliacion = $request->FechaAfiliacion;
			 	$Entrenador->Medicina_Prepago = $request->MedicinaPrepago;
			 	$Entrenador->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
			 	$Entrenador->Riesgo_Laboral = $request->RiesgosLaborales;
			 	$Entrenador->Uso_Medicamento = $request->Medicamento;
			 	$Entrenador->Medicamento = $request->CualMedicamento;
			 	$Entrenador->Tiempo_Medicamento = $request->TiempoMedicamento;
			 	$Entrenador->Otro_Medico_Preg = $request->OtroMedicoPreg;	
			 	$Entrenador->Otro_Medico = $request->OtroMedico;			 	
			 	$Entrenador->Arl_Id = $request->Arl;

			 	$Entrenador->Profesional_Preg = $request->Profesional;
	            $Entrenador->Titulo_Pregrado = $request->TituloPregrado;
	            $Entrenador->Titulo_Especializacion = $request->TituloEspecializacion;
	            $Entrenador->Titulo_Maestria = $request->TituloMaestria;
	            $Entrenador->Titulo_Doctorado = $request->TituloDoctorado;
	            $Entrenador->Curso_Entrenadores = $request->EscalafonEntrenadores;

			 	if(isset($request->FotografiaDep)){
				 	$file1=$request->file('FotografiaDep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
		            $file1->move(public_path().'/Img/EntrenadorFotografias/', $Nom_imagen1);
		            $Entrenador->Archivo1_Url = $Nom_imagen1;
		        }else{
		        	$Entrenador->Archivo1_Url = '';
		        }
		        if($Entrenador->save()){
		        	return response()->json(["Mensaje" => "Entrenador registrado con éxito."]);                	
			 	}else{
			 		return response()->json(["Mensaje" => "Se presento una falla, intentelo de nuevo."]);                	
			 	}	        
	        }    		
    	}
    }    

    public function VincEntrenadorDeportista(){
    	/*$Ciudad = Ciudad::all();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$Departamento = Departamento::all();
		$GrupoSanguineo = GrupoSanguineo::all();
		$Localidad = Localidad::all();
		$NivelRegimenSub = NivelRegimenSub::all();
		$Parentesco = Parentesco::all();
		$RegimenSalud = RegimenSalud::all();
		$TipoAfiliacion = TipoAfiliacion::all();
		$Eps = Eps::all();
		$deportista = array();
		$Pais = Pais::all();
		$Genero = Genero::all();
		$Arl = Arl::all();
		$FondoPension = FondoPension::all();*/
		$entrenador = array();

		return view('TECNICO/entrenadorDeportista',['entrenador' => $entrenador])
		/*->with(compact('Ciudad'))
		->with(compact('ClasificacionDeportista'))
		->with(compact('Departamento'))
		->with(compact('Localidad'))
		->with(compact('GrupoSanguineo'))
		->with(compact('NivelRegimenSub'))
		->with(compact('Parentesco'))
		->with(compact('RegimenSalud'))
		->with(compact('TipoAfiliacion'))
		->with(compact('Eps'))
		->with(compact('Pais'))
		->with(compact('Genero'))		
		->with(compact('Arl'))		
		->with(compact('FondoPension'))	*/
		;

    }

    public function BuscarTipoPersonaRUD(Request $request, $cedula){
		if ($request->ajax()) {

			$Persona = Persona:: with('tipo')->where('Cedula', $cedula)->get();

			if(count($Persona) != 0){
				foreach ($Persona[0]->tipo as $key => $tipo) {
					if($tipo['Id_Tipo'] == 47 || $tipo['Id_Tipo'] == 49){
						return response()->json(["Respuesta" => '1', "Mensaje" => "Esta persona ya se encuentra registrada como un deportista, por favor verifique la información!."]);
					}else if($tipo['Id_Tipo'] == 59){
						return response()->json(["Respuesta" => '2', "Mensaje" => "Esta persona ya se encuentra registrada como un entrenador, por favor verifique la información!."]);
					}
				}
			}else{
				return response()->json(["Respuesta" => '1', "Mensaje" => "No se encuentra ninguna persona registrada con estos datos."]);

			}
		}
	}

	public function entrenadorDeportistaDatos(Request $request, $id_persona){//Solo Tipos que NO esten vinculados a la persona
		$Persona = Persona::with('tipo')->find($id_persona);	
		dd($Persona);
/*		$TipoLista = $Persona->tipo->lists('Id_Tipo');
		$Tipo = Tipo::where('Id_Modulo', '=', 28)->whereNotIn('Id_Tipo', $TipoLista)->get();
		return $Tipo;*/
	}

}

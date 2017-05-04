<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroDeportista;
use Mail;
use mikehaertl\wkhtmlto\Pdf;

use App\Models\Banco;
use App\Models\Ciudad;
use App\Models\ClasificacionDeportista;
use App\Models\Departamento;
use App\Models\EstadoCivil;
use App\Models\Estrato;
use App\Models\GrupoSanguineo;
use App\Models\Localidad;
use App\Models\NivelRegimenSub;
use App\Models\Parentesco;
use App\Models\RegimenSalud;
use App\Models\Talla;
use App\Models\TipoAfiliacion;
use App\Models\TipoCuenta;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Genero;
use App\Models\TipoTalla;
use App\Models\Arl;
use App\Models\FondoPension;
use App\Models\Deportista;
use App\Models\Agrupacion;
use App\Models\Deporte;
use App\Models\DeportistaDeporte;
use App\Models\Club;
use App\Models\Etapa;
use App\Models\TipoEtapa;
use App\Models\DeportistaEtapa;
use App\Models\PersonaTipo;
use App\Models\Diagnostico;
use App\Models\ClasificacionFuncional;
use App\Models\UsoSilla;
use App\Models\DeportistaParalimpico;
use App\Models\Discapacidad;
use App\Models\Modalidad;
use App\Models\DeporteDiscapacidad;
use App\Models\ModalidadClasificacionFuncional;

class DeportistaController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){
		$Banco = Banco::all();
		$Ciudad = Ciudad::all();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$Departamento = Departamento::all();
		$EstadoCivil = EstadoCivil::all();
		$Estrato = Estrato::all();
		$GrupoSanguineo = GrupoSanguineo::all();
		$Localidad = Localidad::all();
		$NivelRegimenSub = NivelRegimenSub::all();
		$Parentesco = Parentesco::all();
		$RegimenSalud = RegimenSalud::all();
		$TipoAfiliacion = TipoAfiliacion::all();
		$TipoCuenta = TipoCuenta::all();
		$Eps = Eps::all();
		$deportista = array();
		$Pais = Pais::all();
		$Genero = Genero::all();
		$Arl = Arl::all();
		$FondoPension = FondoPension::all();
		$Club = Club::all();
		$Diagnostico = Diagnostico::all();
		$UsoSilla = UsoSilla::all();
		$Discapacidad = Discapacidad::all();

		return view('SIAB/deportista',['deportista' => $deportista])
		->with(compact('Banco'))
		->with(compact('Ciudad'))
		->with(compact('ClasificacionDeportista'))
		->with(compact('Departamento'))
		->with(compact('EstadoCivil'))
		->with(compact('Estrato'))
		->with(compact('Localidad'))
		->with(compact('GrupoSanguineo'))
		->with(compact('NivelRegimenSub'))
		->with(compact('Parentesco'))
		->with(compact('RegimenSalud'))
		->with(compact('TipoAfiliacion'))
		->with(compact('TipoCuenta'))
		->with(compact('Eps'))
		->with(compact('Pais'))
		->with(compact('Genero'))		
		->with(compact('Arl'))		
		->with(compact('FondoPension'))		
		->with(compact('Club'))
		->with(compact('Diagnostico'))		
		->with(compact('ClasificacionFuncional'))
		->with(compact('UsoSilla'))
		->with(compact('Discapacidad'))
		;
	}

 	public function datos($id){
        $persona = Persona::with('deportista', 
        						 'deportista.deportistaValoracion', 
        						 'deportista.deportistaValoracion.idioma', 
        						 'deportista.deportistaValoracion.quien', 
        						 'deportista.deportistaValoracion.preguntaA',
        						 'deportista.deportistaValoracion.valoracionRiesgo', 
        						 'deportista.deportistaVisita',
        						 'deportista.deportistaVisita.preguntaA',
        						 'deportista.deportistaVisita.miembros',
        						 'deportista.deportistaParalimpico'
        					)->find($id);
        return $persona;
    }

    public function Tallas(Request $request, $Genero_Id, $Tipo_Id){
        if ($request->ajax()) {
            $tallas = TipoTalla::with('tipo_talla', 'tipo_talla.genero')->find($Tipo_Id);
            $talla_genero = $tallas->tipo_talla->whereIn('Genero_Id', [(int)$Genero_Id]);
            $final = $talla_genero->sortBy('Eu');
            return $final;
        }        
        
    }

    public function RegistrarDeportista(RegistroDeportista $request){ 
    	
    	/*if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$deportista = new Deportista;
	    		$deportista->Persona_Id = $request->persona;
	    		$deportista->Pertenece = $request->Pertenece;
	    		$deportista->Lugar_Expedicion_Id = $request->LugarExpedicion;
	    		$deportista->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
	    		$deportista->Departamento_Id_Nac = $request->DepartamentoNac;
	    		$deportista->Parentesco_Id = $request->Parentesco;
	    		$deportista->Departamento_Id_Localiza = $request->DepartamentoLoc;
	    		$deportista->Ciudad_Id_Localiza = $request->MunicipioLoc;
	    		$deportista->Localidad_Id_Localiza = $request->Localidad;
	    		$deportista->Estado_Civil_Id = $request->EstadoCivil;
	    		$deportista->Estrato_Id = $request->Estrato;
	    		$deportista->Regimen_Salud_Id = $request->Regimen;
	    		$deportista->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
	    		$deportista->Nivel_Regimen_Sub_Id = $request->NivelRegimen;
	    		$deportista->Eps_Id = $request->Eps;
	    		$deportista->Sudadera_Talla_Id = $request->Sudadera;
	    		$deportista->Camiseta_Talla_Id = $request->Camiseta;
	    		$deportista->Pantaloneta_Talla_Id = $request->Pantaloneta;
	    		$deportista->Tenis_Talla_Id = $request->Tenis;
	    		$deportista->Grupo_Sanguineo_Id = $request->GrupoSanguineo;
	    		$deportista->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
	    		$deportista->Fondo_Pension_Id = $request->FondoPension;
	    		$deportista->Fecha_Expedicion = $request->FechaExpedicion;
	    		$deportista->Numero_Pasaporte = $request->Pasaporte;
			 	$deportista->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
			 	$deportista->Libreta_Preg = $request->LibretaPreg;
			 	$deportista->Numero_Libreta_Mil = $request->Libreta;
			 	$deportista->Distrito_Libreta_Mil = $request->Distrito;
			 	$deportista->Nombre_Contacto = $request->NombreContacto;
			 	$deportista->Fijo_Contacto = $request->FijoContacto;
			 	$deportista->Celular_Contacto = $request->CelularContacto;
			 	$deportista->Barrio_Localiza = $request->Barrio;
			 	$deportista->Direccion_Localiza = $request->Direccion;
			 	$deportista->Fijo_Localiza = $request->FijoLoc;
			 	$deportista->Celular_Localiza = $request->CelularLoc;
			 	$deportista->Correo_Electronico = $request->Correo;
			 	$deportista->Numero_Hijos = $request->NumeroHijos;
			 	$deportista->Numero_Cuenta = $request->NumeroCuenta;
			 	$deportista->Fecha_Afiliacion = $request->FechaAfiliacion;
			 	$deportista->Medicina_Prepago = $request->MedicinaPrepago;
			 	$deportista->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
			 	$deportista->Riesgo_Laboral = $request->RiesgosLaborales;
			 	$deportista->Uso_Medicamento = $request->Medicamento;
			 	$deportista->Medicamento = $request->CualMedicamento;
			 	$deportista->Tiempo_Medicamento = $request->TiempoMedicamento;
			 	$deportista->Otro_Medico_Preg = $request->OtroMedicoPreg;	
			 	$deportista->Otro_Medico = $request->OtroMedico;
			 	$deportista->Tipo_Cuenta_Id = $request->TipoCuenta;
			 	$deportista->Banco_Id = $request->Banco;
			 	$deportista->Arl_Id = $request->Arl;
			 	$deportista->Resolucion_Vigente = $request->Resolucion;
			 	$deportista->Deber_Obligacion = $request->Deberes;

			 	if(isset($request->FotografiaDep)){
				 	$file1=$request->file('FotografiaDep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
		            $file1->move(public_path().'/Img/Fotografias/', $Nom_imagen1);
		            $deportista->Archivo1_Url = $Nom_imagen1;
		        }else{
		        	$deportista->Archivo1_Url = '';
		        }

			 	if($deportista->save()){

			 		$PersonaTipo = new PersonaTipo;
			 		//$PersonaTipo->Id_Tipo = 49;  // Pruebas
			 		$PersonaTipo->Id_Tipo = 47;
			 		$PersonaTipo->Id_Persona = $request->persona;
			 		$PersonaTipo->save();

			 		$deportistaDeporte = new DeportistaDeporte;
				 	$deportistaDeporte->Deportista_Id = $deportista->Id;
				 	$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
				 	$deportistaDeporte->Deporte_Id = $request->Deporte;
				 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;
				 	$deportistaDeporte->Club_Id = $request->Club;
				 	$deportistaDeporte->save();

				 	if($request->Pertenece == 1){
				 		$sueldo = $request->Smmlv;
					 	$deportistaEtapaN = new deportistaEtapa;
					 	$deportistaEtapaN->Deportista_Id = $deportista->Id;
					 	$deportistaEtapaN->Etapa_Id = $request->EtapaNacional;
					 	$deportistaEtapaN->Smmlv = $sueldo;
					 	$deportistaEtapaN->save();

					 	$deportistaEtapaI = new deportistaEtapa;
					 	$deportistaEtapaI->Deportista_Id = $deportista->Id;
					 	$deportistaEtapaI->Etapa_Id = $request->EtapaInternacional;
					 	$deportistaEtapaI->Smmlv = $sueldo;
					 	$deportistaEtapaI->save();
					 }
					 if($request->ClasificacionDeportista == 2){

					 	$DeportistaParalimpico = new DeportistaParalimpico;
					 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
					 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
					 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
					 	$DeportistaParalimpico->Silla_Id = $request->Silla;
					 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
					 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
					 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
					 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
					 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
					 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
					 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
					 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
					 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
					 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
					 	$DeportistaParalimpico->save();
					 }

					$this->sendEmail($request->Correo, 'Novice', 'SIAB.correo');
					
				 	return response()->json(["Mensaje" => "Deportista registrado con éxito."]);                	
			 	}else{
			 		return response()->json(["Mensaje" => "Se presento una falla, intentelo de nuevo."]);                	
			 	}
	        }    		
    	}*/
    	if ($request->ajax()) { 

    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$deportista = new Deportista;
	    		$deportista->Persona_Id = $request->persona;
	    		$deportista->Pertenece = $request->Pertenece;
	    		$deportista->Lugar_Expedicion_Id = $request->LugarExpedicion;
	    		$deportista->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
	    		$deportista->Departamento_Id_Nac = $request->DepartamentoNac;
	    		if($request->Parentesco != ''){
	    			$deportista->Parentesco_Id = $request->Parentesco;
	    		}
	    		$deportista->Departamento_Id_Localiza = $request->DepartamentoLoc;
	    		$deportista->Ciudad_Id_Localiza = $request->MunicipioLoc;
	    		$deportista->Localidad_Id_Localiza = $request->Localidad;
	    		if($request->EstadoCivil != ''){
	    			$deportista->Estado_Civil_Id = $request->EstadoCivil;
	    		}
	    		if($request->Estrato != ''){
	    			$deportista->Estrato_Id = $request->Estrato;
	    		}
	    		if($request->Regimen != ''){
	    			$deportista->Regimen_Salud_Id = $request->Regimen;
	    		}
	    		if($request->TipoAfiliacion != ''){
	    			$deportista->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
	    		}
	    		if($request->NivelRegimen != ''){
	    			$deportista->Nivel_Regimen_Sub_Id = $request->NivelRegimen;	
	    		}
	    		$deportista->Eps_Id = $request->Eps;
	    		if($request->Sudadera != ''){
	    			$deportista->Sudadera_Talla_Id = $request->Sudadera;
	    		}
	    		if($request->Camiseta != ''){
	    			$deportista->Camiseta_Talla_Id = $request->Camiseta;
	    		}
	    		if($request->Pantaloneta != ''){
	    			$deportista->Pantaloneta_Talla_Id = $request->Pantaloneta;
	    		}
	    		if($request->Tenis != ''){
	    			$deportista->Tenis_Talla_Id = $request->Tenis;
	    		}
	    		$deportista->Grupo_Sanguineo_Id = $request->GrupoSanguineo;

	    		if($request->FondoPensionPreg != ''){
	    			$deportista->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
	    		}
	    		if($request->FondoPension != ''){
	    			$deportista->Fondo_Pension_Id = $request->FondoPension;
	    		}
	    		$deportista->Fecha_Expedicion = $request->FechaExpedicion;
	    		$deportista->Numero_Pasaporte = $request->Pasaporte;
			 	$deportista->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
			 	$deportista->Libreta_Preg = $request->LibretaPreg;
			 	$deportista->Numero_Libreta_Mil = $request->Libreta;
			 	$deportista->Distrito_Libreta_Mil = $request->Distrito;
			 	$deportista->Nombre_Contacto = $request->NombreContacto;
			 	$deportista->Fijo_Contacto = $request->FijoContacto;
			 	$deportista->Celular_Contacto = $request->CelularContacto;
			 	$deportista->Barrio_Localiza = $request->Barrio;
			 	$deportista->Direccion_Localiza = $request->Direccion;
			 	$deportista->Fijo_Localiza = $request->FijoLoc;
			 	$deportista->Celular_Localiza = $request->CelularLoc;
			 	$deportista->Correo_Electronico = $request->Correo;
			 	$deportista->Numero_Hijos = $request->NumeroHijos;
			 	$deportista->Numero_Cuenta = $request->NumeroCuenta;
			 	$deportista->Fecha_Afiliacion = $request->FechaAfiliacion;
			 	$deportista->Medicina_Prepago = $request->MedicinaPrepago;
			 	$deportista->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
			 	$deportista->Riesgo_Laboral = $request->RiesgosLaborales;
			 	$deportista->Uso_Medicamento = $request->Medicamento;
			 	$deportista->Medicamento = $request->CualMedicamento;
			 	$deportista->Tiempo_Medicamento = $request->TiempoMedicamento;
			 	$deportista->Otro_Medico_Preg = $request->OtroMedicoPreg;	
			 	$deportista->Otro_Medico = $request->OtroMedico;
			 	if($request->TipoCuenta != ''){
			 		$deportista->Tipo_Cuenta_Id = $request->TipoCuenta;
			 	}
			 	if($request->Banco != ''){
			 		$deportista->Banco_Id = $request->Banco;
			 	}
			 	$deportista->Arl_Id = $request->Arl;
			 	$deportista->Resolucion_Vigente = $request->Resolucion;
			 	$deportista->Deber_Obligacion = $request->Deberes;

			 	if(isset($request->FotografiaDep)){
				 	$file1=$request->file('FotografiaDep');
		            $extension1=$file1->getClientOriginalExtension();
		            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
		            $file1->move(public_path().'/Img/Fotografias/', $Nom_imagen1);
		            $deportista->Archivo1_Url = $Nom_imagen1;
		        }else{
		        	$deportista->Archivo1_Url = '';
		        }

			 	if($deportista->save()){

			 		$PersonaTipo = new PersonaTipo;
			 		//$PersonaTipo->Id_Tipo = 49;  // Pruebas
			 		$PersonaTipo->Id_Tipo = 47;
			 		$PersonaTipo->Id_Persona = $request->persona;
			 		$PersonaTipo->save();

			 		$deportistaDeporte = new DeportistaDeporte;
				 	$deportistaDeporte->Deportista_Id = $deportista->Id;
				 	if($request->ClasificacionDeportista == 1){
				 		$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
					 	$deportistaDeporte->Deporte_Id = $request->Deporte;
					 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;	
				 	}elseif($request->ClasificacionDeportista == 2){
				 		$deportistaDeporte->Agrupacion_Id = $request->AgrupacionP;
					 	$deportistaDeporte->Deporte_Id = $request->DeporteP;
					 	$deportistaDeporte->Modalidad_Id = $request->ModalidadP;
				 	}
				 	
				 	$deportistaDeporte->Club_Id = $request->Club;
				 	$deportistaDeporte->save();

				 	if($request->Pertenece == 1){
				 		$sueldo = $request->Smmlv;
					 	$deportistaEtapaN = new deportistaEtapa;
					 	$deportistaEtapaN->Deportista_Id = $deportista->Id;
					 	$deportistaEtapaN->Etapa_Id = $request->EtapaNacional;
					 	$deportistaEtapaN->Smmlv = $sueldo;
					 	$deportistaEtapaN->save();

					 	$deportistaEtapaI = new deportistaEtapa;
					 	$deportistaEtapaI->Deportista_Id = $deportista->Id;
					 	$deportistaEtapaI->Etapa_Id = $request->EtapaInternacional;
					 	$deportistaEtapaI->Smmlv = $sueldo;
					 	$deportistaEtapaI->save();
					 }
					 if($request->ClasificacionDeportista == 2){

					 	$DeportistaParalimpico = new DeportistaParalimpico;
					 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
					 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
					 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
					 	$DeportistaParalimpico->Silla_Id = $request->Silla;
					 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
					 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
					 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
					 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
					 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
					 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
					 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
					 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
					 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
					 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
					 	$DeportistaParalimpico->save();
					 }

					$this->sendEmail($request->Correo, 'Novice', 'SIAB.correo');
					
				 	return response()->json(["Mensaje" => "Deportista registrado con éxito."]);                	
			 	}else{
			 		return response()->json(["Mensaje" => "Se presento una falla, intentelo de nuevo."]);                	
			 	}
	        }    		
    	}
    }

    public function ModificarDeportista(RegistroDeportista $request){
    	/*if ($request->ajax()) { 

    		$DeportistaDeporte = Deportista::with('deportistaDeporte')->find($request->deportista);
	    	$dep = $DeportistaDeporte->deportistaDeporte[count($DeportistaDeporte->deportistaDeporte)-1];

	    	if($dep['Agrupacion_Id'] != $request->Agrupacion || $dep['Deporte_Id'] != $request->Deporte || $dep['Modalidad_Id'] != $request->Modalidad || $dep['Club_Id'] != $request->Club){	    		
	    		$deportistaDeporte = new DeportistaDeporte;
			 	$deportistaDeporte->Deportista_Id = $request->deportista;
			 	$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
			 	$deportistaDeporte->Deporte_Id = $request->Deporte;
			 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;
			 	$deportistaDeporte->Club_Id = $request->Club;
			 	$deportistaDeporte->save();
	    	}

    		$deportista = Deportista::find($request->deportista);
    		$deportista->Persona_Id = $request->persona;
    		$deportista->Pertenece = $request->Pertenece;
    		$deportista->Lugar_Expedicion_Id = $request->LugarExpedicion;
    		$deportista->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
    		$deportista->Departamento_Id_Nac = $request->DepartamentoNac;
    		$deportista->Parentesco_Id = $request->Parentesco;
    		$deportista->Departamento_Id_Localiza = $request->DepartamentoLoc;
    		$deportista->Ciudad_Id_Localiza = $request->MunicipioLoc;
    		$deportista->Localidad_Id_Localiza = $request->Localidad;
    		$deportista->Estado_Civil_Id = $request->EstadoCivil;
    		$deportista->Estrato_Id = $request->Estrato;
    		$deportista->Regimen_Salud_Id = $request->Regimen;
    		$deportista->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
    		$deportista->Nivel_Regimen_Sub_Id = $request->NivelRegimen;
    		$deportista->Eps_Id = $request->Eps;
    		$deportista->Sudadera_Talla_Id = $request->Sudadera;
    		$deportista->Camiseta_Talla_Id = $request->Camiseta;
    		$deportista->Pantaloneta_Talla_Id = $request->Pantaloneta;
    		$deportista->Tenis_Talla_Id = $request->Tenis;
    		$deportista->Grupo_Sanguineo_Id = $request->GrupoSanguineo;
    		$deportista->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
    		$deportista->Fondo_Pension_Id = $request->FondoPension;
    		$deportista->Fecha_Expedicion = $request->FechaExpedicion;
    		$deportista->Numero_Pasaporte = $request->Pasaporte;
		 	$deportista->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
		 	$deportista->Libreta_Preg = $request->LibretaPreg;
		 	$deportista->Numero_Libreta_Mil = $request->Libreta;
		 	$deportista->Distrito_Libreta_Mil = $request->Distrito;
		 	$deportista->Nombre_Contacto = $request->NombreContacto;
		 	$deportista->Fijo_Contacto = $request->FijoContacto;
		 	$deportista->Celular_Contacto = $request->CelularContacto;
		 	$deportista->Barrio_Localiza = $request->Barrio;
		 	$deportista->Direccion_Localiza = $request->Direccion;
		 	$deportista->Fijo_Localiza = $request->FijoLoc;
		 	$deportista->Celular_Localiza = $request->CelularLoc;
		 	$deportista->Correo_Electronico = $request->Correo;
		 	$deportista->Numero_Hijos = $request->NumeroHijos;
		 	$deportista->Numero_Cuenta = $request->NumeroCuenta;
		 	$deportista->Fecha_Afiliacion = $request->FechaAfiliacion;
		 	$deportista->Medicina_Prepago = $request->MedicinaPrepago;
		 	$deportista->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
		 	$deportista->Riesgo_Laboral = $request->RiesgosLaborales;
		 	$deportista->Uso_Medicamento = $request->Medicamento;
		 	$deportista->Medicamento = $request->CualMedicamento;
		 	$deportista->Tiempo_Medicamento = $request->TiempoMedicamento;
		 	$deportista->Otro_Medico_Preg = $request->OtroMedicoPreg;	
		 	$deportista->Otro_Medico = $request->OtroMedico;
		 	$deportista->Tipo_Cuenta_Id = $request->TipoCuenta;
		 	$deportista->Banco_Id = $request->Banco;
		 	$deportista->Arl_Id = $request->Arl;

		 	if(isset($request->FotografiaDep)){
			 	$file1=$request->file('FotografiaDep');
	            $extension1=$file1->getClientOriginalExtension();
	            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
	            $file1->move(public_path().'/Img/Fotografias/', $Nom_imagen1);
	            $deportista->Archivo1_Url = $Nom_imagen1;
	        }

		 	$deportista->save();

		 	if($request->Pertenece == 1 ){		 		
		 		if(($request->EtapaNacional != $request->EtapaNacionalT) || ($request->EtapaInternacional != $request->EtapaInternacionalT)){
		 			$sueldo = $request->Smmlv;
				 	$deportistaEtapaN = new deportistaEtapa;
				 	$deportistaEtapaN->Deportista_Id = $deportista->Id;
				 	$deportistaEtapaN->Etapa_Id = $request->EtapaNacional;
				 	$deportistaEtapaN->Smmlv = $sueldo;
				 	$deportistaEtapaN->save();

				 	$deportistaEtapaI = new deportistaEtapa;
				 	$deportistaEtapaI->Deportista_Id = $deportista->Id;
				 	$deportistaEtapaI->Etapa_Id = $request->EtapaInternacional;
				 	$deportistaEtapaI->Smmlv = $sueldo;
				 	$deportistaEtapaI->save();
				 }
			}

			if($request->ClasificacionDeportista == 2){
				$DP = DeportistaParalimpico::where('Deportista_Id', $deportista->Id)->get();	

				if(count($DP) > 0){			
					$DeportistaParalimpico = DeportistaParalimpico::find($DP[0]['Id']);
				 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
				 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
				 	$DeportistaParalimpico->Silla_Id = $request->Silla;
				 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
				 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
				 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
				 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
				 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
				 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
				 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
				 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
				 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
				 	$DeportistaParalimpico->save();
				}else{
					$DeportistaParalimpico = new DeportistaParalimpico;
				 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
				 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
				 	$DeportistaParalimpico->Silla_Id = $request->Silla;
				 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
				 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
				 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
				 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
				 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
				 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
				 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
				 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
				 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
				 	$DeportistaParalimpico->save();
				}


			}else{
				$DP = DeportistaParalimpico::where('Deportista_Id', $deportista->Id)->get();
				if(count($DP) > 0){
					$DeportistaParalimpico = DeportistaParalimpico::find($DP[0]['Id']);
					$DeportistaParalimpico->delete();
				}
			}

		 	return response()->json(["Mensaje" => "Deportista modificado con éxito."]);                
    	}*/
    	//dd($request->all());
    	if ($request->ajax()) { 

    		$DeportistaDeporte = Deportista::with('deportistaDeporte')->find($request->deportista);
	    	$dep = $DeportistaDeporte->deportistaDeporte[count($DeportistaDeporte->deportistaDeporte)-1];

	    	if($request['ClasificacionDeportista'] == 1){
	    		if($dep['Agrupacion_Id'] != $request->Agrupacion || $dep['Deporte_Id'] != $request->Deporte || $dep['Modalidad_Id'] != $request->Modalidad || $dep['Club_Id'] != $request->Club){	    		
		    		$deportistaDeporte = new DeportistaDeporte;
				 	$deportistaDeporte->Deportista_Id = $request->deportista;
				 	$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
				 	$deportistaDeporte->Deporte_Id = $request->Deporte;
				 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;
				 	$deportistaDeporte->Club_Id = $request->Club;
				 	$deportistaDeporte->save();
		    	}
	    	}elseif($request['ClasificacionDeportista'] == 2){
	    		if($dep['Agrupacion_Id'] != $request->AgrupacionP || $dep['Deporte_Id'] != $request->DeporteP || $dep['Modalidad_Id'] != $request->ModalidadP || $dep['Club_Id'] != $request->Club){	    		
		    		$deportistaDeporte = new DeportistaDeporte;
				 	$deportistaDeporte->Deportista_Id = $request->deportista;
				 	$deportistaDeporte->Agrupacion_Id = $request->AgrupacionP;
				 	$deportistaDeporte->Deporte_Id = $request->DeporteP;
				 	$deportistaDeporte->Modalidad_Id = $request->ModalidadP;
				 	$deportistaDeporte->Club_Id = $request->Club;
				 	$deportistaDeporte->save();
		    	}
	    	}

	    	

    		$deportista = Deportista::find($request->deportista);
    		/*$deportista->Persona_Id = $request->persona;
    		$deportista->Pertenece = $request->Pertenece;
    		$deportista->Lugar_Expedicion_Id = $request->LugarExpedicion;
    		$deportista->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
    		$deportista->Departamento_Id_Nac = $request->DepartamentoNac;
    		$deportista->Parentesco_Id = $request->Parentesco;
    		$deportista->Departamento_Id_Localiza = $request->DepartamentoLoc;
    		$deportista->Ciudad_Id_Localiza = $request->MunicipioLoc;
    		$deportista->Localidad_Id_Localiza = $request->Localidad;
    		$deportista->Estado_Civil_Id = $request->EstadoCivil;
    		$deportista->Estrato_Id = $request->Estrato;
    		$deportista->Regimen_Salud_Id = $request->Regimen;
    		$deportista->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
    		$deportista->Nivel_Regimen_Sub_Id = $request->NivelRegimen;
    		$deportista->Eps_Id = $request->Eps;
    		$deportista->Sudadera_Talla_Id = $request->Sudadera;
    		$deportista->Camiseta_Talla_Id = $request->Camiseta;
    		$deportista->Pantaloneta_Talla_Id = $request->Pantaloneta;
    		$deportista->Tenis_Talla_Id = $request->Tenis;
    		$deportista->Grupo_Sanguineo_Id = $request->GrupoSanguineo;
    		$deportista->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
    		$deportista->Fondo_Pension_Id = $request->FondoPension;
    		$deportista->Fecha_Expedicion = $request->FechaExpedicion;
    		$deportista->Numero_Pasaporte = $request->Pasaporte;
		 	$deportista->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
		 	$deportista->Libreta_Preg = $request->LibretaPreg;
		 	$deportista->Numero_Libreta_Mil = $request->Libreta;
		 	$deportista->Distrito_Libreta_Mil = $request->Distrito;
		 	$deportista->Nombre_Contacto = $request->NombreContacto;
		 	$deportista->Fijo_Contacto = $request->FijoContacto;
		 	$deportista->Celular_Contacto = $request->CelularContacto;
		 	$deportista->Barrio_Localiza = $request->Barrio;
		 	$deportista->Direccion_Localiza = $request->Direccion;
		 	$deportista->Fijo_Localiza = $request->FijoLoc;
		 	$deportista->Celular_Localiza = $request->CelularLoc;
		 	$deportista->Correo_Electronico = $request->Correo;
		 	$deportista->Numero_Hijos = $request->NumeroHijos;
		 	$deportista->Numero_Cuenta = $request->NumeroCuenta;
		 	$deportista->Fecha_Afiliacion = $request->FechaAfiliacion;
		 	$deportista->Medicina_Prepago = $request->MedicinaPrepago;
		 	$deportista->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
		 	$deportista->Riesgo_Laboral = $request->RiesgosLaborales;
		 	$deportista->Uso_Medicamento = $request->Medicamento;
		 	$deportista->Medicamento = $request->CualMedicamento;
		 	$deportista->Tiempo_Medicamento = $request->TiempoMedicamento;
		 	$deportista->Otro_Medico_Preg = $request->OtroMedicoPreg;	
		 	$deportista->Otro_Medico = $request->OtroMedico;
		 	$deportista->Tipo_Cuenta_Id = $request->TipoCuenta;
		 	$deportista->Banco_Id = $request->Banco;
		 	$deportista->Arl_Id = $request->Arl;*/

		 	$deportista->Persona_Id = $request->persona;
	    		$deportista->Pertenece = $request->Pertenece;
	    		$deportista->Lugar_Expedicion_Id = $request->LugarExpedicion;
	    		$deportista->Clasificacion_Deportista_Id = $request->ClasificacionDeportista;
	    		$deportista->Departamento_Id_Nac = $request->DepartamentoNac;
	    		if($request->Parentesco != ''){
	    			$deportista->Parentesco_Id = $request->Parentesco;
	    		}
	    		$deportista->Departamento_Id_Localiza = $request->DepartamentoLoc;
	    		$deportista->Ciudad_Id_Localiza = $request->MunicipioLoc;
	    		$deportista->Localidad_Id_Localiza = $request->Localidad;
	    		if($request->EstadoCivil != ''){
	    			$deportista->Estado_Civil_Id = $request->EstadoCivil;
	    		}
	    		if($request->Estrato != ''){
	    			$deportista->Estrato_Id = $request->Estrato;
	    		}
	    		if($request->Regimen != ''){
	    			$deportista->Regimen_Salud_Id = $request->Regimen;
	    		}
	    		if($request->TipoAfiliacion != ''){
	    			$deportista->Tipo_Afiliacion_Id = $request->TipoAfiliacion;
	    		}
	    		if($request->NivelRegimen != ''){
	    			$deportista->Nivel_Regimen_Sub_Id = $request->NivelRegimen;	
	    		}
	    		$deportista->Eps_Id = $request->Eps;
	    		if($request->Sudadera != ''){
	    			$deportista->Sudadera_Talla_Id = $request->Sudadera;
	    		}
	    		if($request->Camiseta != ''){
	    			$deportista->Camiseta_Talla_Id = $request->Camiseta;
	    		}
	    		if($request->Pantaloneta != ''){
	    			$deportista->Pantaloneta_Talla_Id = $request->Pantaloneta;
	    		}
	    		if($request->Tenis != ''){
	    			$deportista->Tenis_Talla_Id = $request->Tenis;
	    		}
	    		$deportista->Grupo_Sanguineo_Id = $request->GrupoSanguineo;

	    		if($request->FondoPensionPreg != ''){
	    			$deportista->Fondo_PensionPreg_Id = $request->FondoPensionPreg;
	    		}
	    		if($request->FondoPension != ''){
	    			$deportista->Fondo_Pension_Id = $request->FondoPension;
	    		}
	    		$deportista->Fecha_Expedicion = $request->FechaExpedicion;
	    		$deportista->Numero_Pasaporte = $request->Pasaporte;
			 	$deportista->Fecha_Pasaporte = $request->FechaVigenciaPasaporte;
			 	$deportista->Libreta_Preg = $request->LibretaPreg;
			 	$deportista->Numero_Libreta_Mil = $request->Libreta;
			 	$deportista->Distrito_Libreta_Mil = $request->Distrito;
			 	$deportista->Nombre_Contacto = $request->NombreContacto;
			 	$deportista->Fijo_Contacto = $request->FijoContacto;
			 	$deportista->Celular_Contacto = $request->CelularContacto;
			 	$deportista->Barrio_Localiza = $request->Barrio;
			 	$deportista->Direccion_Localiza = $request->Direccion;
			 	$deportista->Fijo_Localiza = $request->FijoLoc;
			 	$deportista->Celular_Localiza = $request->CelularLoc;
			 	$deportista->Correo_Electronico = $request->Correo;
			 	$deportista->Numero_Hijos = $request->NumeroHijos;
			 	$deportista->Numero_Cuenta = $request->NumeroCuenta;
			 	$deportista->Fecha_Afiliacion = $request->FechaAfiliacion;
			 	$deportista->Medicina_Prepago = $request->MedicinaPrepago;
			 	$deportista->Nombre_MedicinaPrepago = $request->NombreMedicinaPrepago;
			 	$deportista->Riesgo_Laboral = $request->RiesgosLaborales;
			 	$deportista->Uso_Medicamento = $request->Medicamento;
			 	$deportista->Medicamento = $request->CualMedicamento;
			 	$deportista->Tiempo_Medicamento = $request->TiempoMedicamento;
			 	$deportista->Otro_Medico_Preg = $request->OtroMedicoPreg;	
			 	$deportista->Otro_Medico = $request->OtroMedico;
			 	if($request->TipoCuenta != ''){
			 		$deportista->Tipo_Cuenta_Id = $request->TipoCuenta;
			 	}
			 	if($request->Banco != ''){
			 		$deportista->Banco_Id = $request->Banco;
			 	}
			 	$deportista->Arl_Id = $request->Arl;

		 	if(isset($request->FotografiaDep)){
			 	$file1=$request->file('FotografiaDep');
	            $extension1=$file1->getClientOriginalExtension();
	            $Nom_imagen1 = "FotografiaDep-".$request->persona.'.'.$extension1;
	            $file1->move(public_path().'/Img/Fotografias/', $Nom_imagen1);
	            $deportista->Archivo1_Url = $Nom_imagen1;
	        }

		 	$deportista->save();

		 	if($request->Pertenece == 1 ){		 		
		 		if(($request->EtapaNacional != $request->EtapaNacionalT) || ($request->EtapaInternacional != $request->EtapaInternacionalT)){
		 			$sueldo = $request->Smmlv;
				 	$deportistaEtapaN = new deportistaEtapa;
				 	$deportistaEtapaN->Deportista_Id = $deportista->Id;
				 	$deportistaEtapaN->Etapa_Id = $request->EtapaNacional;
				 	$deportistaEtapaN->Smmlv = $sueldo;
				 	$deportistaEtapaN->save();

				 	$deportistaEtapaI = new deportistaEtapa;
				 	$deportistaEtapaI->Deportista_Id = $deportista->Id;
				 	$deportistaEtapaI->Etapa_Id = $request->EtapaInternacional;
				 	$deportistaEtapaI->Smmlv = $sueldo;
				 	$deportistaEtapaI->save();
				 }
			}

			if($request->ClasificacionDeportista == 2){
				$DP = DeportistaParalimpico::where('Deportista_Id', $deportista->Id)->get();	

				if(count($DP) > 0){			
					$DeportistaParalimpico = DeportistaParalimpico::find($DP[0]['Id']);
				 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
				 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
				 	$DeportistaParalimpico->Silla_Id = $request->Silla;
				 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
				 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
				 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
				 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
				 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
				 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
				 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
				 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
				 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
				 	$DeportistaParalimpico->save();
				}else{
					$DeportistaParalimpico = new DeportistaParalimpico;
				 	$DeportistaParalimpico->Deportista_Id = $deportista->Id;
				 	$DeportistaParalimpico->Diagnostico_Id = $request->Diagnostico;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Id = $request->ClasificacionFuncional;
				 	$DeportistaParalimpico->Silla_Id = $request->Silla;
				 	$DeportistaParalimpico->Uso_Silla_Id = $request->Cuidador;
				 	$DeportistaParalimpico->Auxiliar_Id = $request->Auxiliar;
				 	$DeportistaParalimpico->Clasificacion_Funcional_Internacional_Id = $request->ClasificadoNivelInternacional;
				 	$DeportistaParalimpico->Discapacidad_Id = $request->Discapacidad;
				 	$DeportistaParalimpico->EdadAdquirido = $request->DiagnosticoEdad;
				 	$DeportistaParalimpico->Fecha_Clasificacion = $request->FechaCI;
				 	$DeportistaParalimpico->Evento_Clasificacion = $request->EventoCI;
				 	$DeportistaParalimpico->EdadDeportiva = $request->EdadDeportiva;
				 	$DeportistaParalimpico->Resultado_Nacional = $request->resultadoNacional;
				 	$DeportistaParalimpico->Resultado_Internacional = $request->resultadoInternacional;
				 	$DeportistaParalimpico->save();
				}


			}else{
				$DP = DeportistaParalimpico::where('Deportista_Id', $deportista->Id)->get();
				if(count($DP) > 0){
					$DeportistaParalimpico = DeportistaParalimpico::find($DP[0]['Id']);
					$DeportistaParalimpico->delete();
				}
			}

		 	return response()->json(["Mensaje" => "Deportista modificado con éxito."]);                
    	}
    }

    public function Agrupaciones(Request $request, $id){
    	if ($request->ajax()) { 
	    	$Agrupaciones = ClasificacionDeportista::with('agrupacion')->find($id);
	    	return ($Agrupaciones);
	    }
    }

    public function Deportes(Request $request, $id){
    	if ($request->ajax()) { 
	    	$Deportes = Agrupacion::with('deporte')->find($id);
	    	return ($Deportes);
	    }
    }

    public function Modalidades(Request $request, $id){
    	if ($request->ajax()) { 
	    	$Modalidades = Deporte::with('modalidad')->find($id);
	    	return ($Modalidades);
	    }
    }

    public function DeportistaDeporte(Request $request, $id){
    	if ($request->ajax()) { 
	    	$DeportistaDeporte = Deportista::with('deportistaDeporte')->find($id);
	    	return ($DeportistaDeporte->deportistaDeporte[count($DeportistaDeporte->deportistaDeporte)-1]);
	    }
    }

    public function Etapas(Request $request, $id_clasificacion){
    	if ($request->ajax()) { 
	    	$Etapas = ClasificacionDeportista::with('tipoEtapa.etapa')->find($id_clasificacion);
	    	return response()->json(["Nacional" => $Etapas->tipoEtapa[0]->etapa, "Internacional" => $Etapas->tipoEtapa[1]->etapa]);
	    }
    }

    public function getDeportistaEtapas(Request $request, $id_deportista){
    	$Etapas = Deportista::with('deportistaEtapa')->find($id_deportista);
    	$Nacional = $Etapas->deportistaEtapa()->whereIn('Tipo_Etapa_id', [1, 3])->orderBy('deportista_etapa.created_at', 'desc')->first();
    	$Internacional = $Etapas->deportistaEtapa()->whereIn('Tipo_Etapa_id', [2, 4])->orderBy('deportista_etapa.created_at', 'desc')->first();
    	return response()->json(["Nacional" => $Nacional, "Internacional" => $Internacional]);   	
    }

    public function sendEmail($correo, $nombre, $plantilla){
    	$datos[0] = $correo;
    	$datos[1] = $nombre;
    	$datos[2] = $plantilla;
    	Mail::send($datos[2], ['name' => $datos[1]], function($message) use ($datos){			
		    $message->to($datos[0], 'IDRD')->subject('Registro de deportista exitoso!');
		});
    } 

    public function TallaTenis(Request $request, $id){
        if ($request->ajax()) {
            $tallas = Talla::find($id);            
            return($tallas);
        }
    }  

    public function GetDeporteParalimpico(Request $request, $id_agrupacion, $id_discapacidad){
    	$DeporteDiscapacidad = DeporteDiscapacidad::where('Discapacidad_Id', $id_discapacidad)->lists('Deporte_Id');
    	$Deporte = Deporte::where('Agrupacion_Id', $id_agrupacion)->whereIn('Id', $DeporteDiscapacidad)->get();
    	return $Deporte;
    }

    public function ClasificacionesFuncionales(Request $request, $id_modalidad){
    	if ($request->ajax()) { 
    		$Modalidad = Modalidad::with('ModalidadClasificacionFuncional')->find($id_modalidad);
    		return $Modalidad->ModalidadClasificacionFuncional;
    	}
    }
}
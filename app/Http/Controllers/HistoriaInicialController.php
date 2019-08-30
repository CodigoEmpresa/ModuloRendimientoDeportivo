<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroHistoriaInicial;

use App\Models\Persona;
use App\Models\Genero;
use App\Models\EstadoCivil;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Estrato;
use App\Models\Localidad;
use App\Models\Eps;
use App\Models\ClasificacionDeportista;
use App\Models\Deportista;
use App\Models\Agrupacion;
use App\Models\Deporte;
use App\Models\DeportistaDeporte;
use App\Models\PersonaTipo;
use App\Models\DeportistaParalimpico;
use App\Models\Modalidad;
use App\Models\Discapacidad;
use App\Models\Ocupacion;
use App\Models\NivelEstudio;
use App\Models\Dominancia;
use App\Models\Aptitud;
use App\Models\HistoriaInicial;
use App\Models\HistoriaInicialConsulta;
use App\Models\HistoriaInicialExamenFisico;
use App\Models\HistoriaInicialGinecologico;
use App\Models\HistoriaInicialOsteomuscular;
use App\Models\HistoriaInicialPatologico;
use App\Models\HistoriaInicialResultado;
use App\Models\HistoriaInicialEvolucion;

class HistoriaInicialController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];
		$this->repositorio_personas = $repositorio_personas;
	}

    public function index(){

		$Ciudad = Ciudad::all();
		$ClasificacionDeportista = ClasificacionDeportista::all();
		$Departamento = Departamento::all();
		$EstadoCivil = EstadoCivil::all();
		$Estrato = Estrato::all();
		$Localidad = Localidad::all();		
		$Eps = Eps::all();
		$deportista = array();
		$Pais = Pais::all();
		$Genero = Genero::all();		
		$Discapacidad = Discapacidad::all();
		$Ocupacion = Ocupacion::all();
		$NivelEstudio = NivelEstudio::all();
		$Dominancia = Dominancia::all();
		$Aptitud = Aptitud::all();

		return view('UCAD/historia_inicial',['deportista' => $deportista])
		->with(compact('Ciudad'))
		->with(compact('ClasificacionDeportista'))
		->with(compact('Departamento'))
		->with(compact('EstadoCivil'))
		->with(compact('Estrato'))
		->with(compact('Localidad'))		
		->with(compact('Eps'))
		->with(compact('Pais'))
		->with(compact('Genero'))			
		->with(compact('ClasificacionFuncional'))
		->with(compact('Discapacidad'))
		->with(compact('Ocupacion'))
		->with(compact('NivelEstudio'))
		->with(compact('Dominancia'))
		->with(compact('Aptitud'))
		;
	}

	public function GetHistoriaUnica(Request $request, $id_historia_inicial){
		$HistoriaInicial = HistoriaInicial::with('historiaInicialConsulta',
					                             'historiaInicialExamenFisico',
					                             'historiaInicialGinecologico',
					                             'historiaInicialOsteomuscular',
					                             'historiaInicialPatologico',
					                             'historiaInicialResultado',
					                             'historiaInicialEvolucion')		
										   ->find($id_historia_inicial);
		return $HistoriaInicial;
	}

	public function AgregarHistoriaInicial(RegistroHistoriaInicial $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{	        	
	        	$HistoriaInicial = new HistoriaInicial;
	        	$HistoriaInicial->Deportista_Id = $request->deportista;
	        	$HistoriaInicial->Ocupacion_Id = $request->Ocupacion;
	        	$HistoriaInicial->NivelEstudio_Id = $request->NivelEstudio;
	        	$HistoriaInicial->Dominancia_Id = $request->Dominancia;
	        	$HistoriaInicial->Medico_Id = $_SESSION['Usuario'][0];
	        	$HistoriaInicial->Edad_Deportiva = $request->EdadDeportiva;
	        	$HistoriaInicial->Nombre_Padre = $request->NombrePadre;
	        	$HistoriaInicial->Nombre_Madre = $request->NombreMadre;
	        	$HistoriaInicial->Entrenamiento_Continuo_Preg = $request->EntrenamientoContinuoPreg;
	        	$HistoriaInicial->Plan_Entrenamiento_Preg = $request->PlanEntrenamientoPreg;
	        	$HistoriaInicial->Nombre_Acudiente = $request->NombreAcudiente;
	        	$HistoriaInicial->Telefono_Acudiente = $request->TelefonoAcudiente;
	        	$HistoriaInicial->Nombre_Responsable = $request->NombreResponsable;
	        	$HistoriaInicial->Telefono_Responsable = $request->TelefonoResponsable;


	        	if($HistoriaInicial->save()){
					$HistoriaInicialConsulta = new HistoriaInicialConsulta();
					$HistoriaInicialConsulta->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialConsulta->Descripcion = $request->MotivoConsulta;
					$HistoriaInicialConsulta->save();

					$HistoriaInicialOsteomuscular = new HistoriaInicialOsteomuscular();
					$HistoriaInicialOsteomuscular->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialOsteomuscular->Descripcion = $request->AntecedenteOsteomusculares;
					$HistoriaInicialOsteomuscular->save();

					$HistoriaInicialPatologico = new HistoriaInicialPatologico();
					$HistoriaInicialPatologico->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialPatologico->Descripcion = $request->AntecedentePatologico;
					$HistoriaInicialPatologico->save();

					$HistoriaInicialGinecologico = new HistoriaInicialGinecologico();
					$HistoriaInicialGinecologico->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialGinecologico->Menarquia = $request->Menarquia;
					$HistoriaInicialGinecologico->Ciclo = $request->Ciclo;
					$HistoriaInicialGinecologico->Ciclo = $request->Regular;
					$HistoriaInicialGinecologico->Dismenorrea = $request->Dismenorrea;
					$HistoriaInicialGinecologico->Fum = $request->Fum;
					$HistoriaInicialGinecologico->Fup = $request->Fup;
					$HistoriaInicialGinecologico->G = $request->G;
					$HistoriaInicialGinecologico->P = $request->P;
					$HistoriaInicialGinecologico->V = $request->V;
					$HistoriaInicialGinecologico->A = $request->A;
					$HistoriaInicialGinecologico->Amenorrea = $request->Amenorrea;
					$HistoriaInicialGinecologico->Planifica_Preg = $request->Planifica;
					$HistoriaInicialGinecologico->Metodo_Planificacion = $request->Metodo;
					$HistoriaInicialGinecologico->save();

					$HistoriaInicialResultado = new HistoriaInicialResultado();
					$HistoriaInicialResultado->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialResultado->Diagnostico = $request->Diagnostico;
					$HistoriaInicialResultado->Incapacacidad_Provisional = $request->IncapacidadProvisional;
					$HistoriaInicialResultado->Aptitud_Id = $request->Aptitud;
					$HistoriaInicialResultado->Recomendacion_Tratamiento = $request->Recomendaciones;
					$HistoriaInicialResultado->save();

					$HistoriaInicialExamenFisico = new HistoriaInicialExamenFisico();
					$HistoriaInicialExamenFisico->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialExamenFisico->Pa_Pie_Dato = $request->DatoPaPie;
					$HistoriaInicialExamenFisico->Pa_Pie_Observacion = $request->ObservacionPaPie;
					$HistoriaInicialExamenFisico->Pa_Supino_Dato = $request->DatoPaSupino;
					$HistoriaInicialExamenFisico->Pa_Supino_Observacion = $request->ObservacionPaSupino;
					$HistoriaInicialExamenFisico->Fc_Reposo_Dato = $request->DatoFCReposo;
					$HistoriaInicialExamenFisico->Fc_Reposo_Observacion = $request->ObservacionFCReposo;
					$HistoriaInicialExamenFisico->Fr_Dato = $request->DatoFR;
					$HistoriaInicialExamenFisico->Fr_Observacion = $request->ObservacionFR;
					$HistoriaInicialExamenFisico->Temperatura_Dato = $request->DatoTemperatura;
					$HistoriaInicialExamenFisico->Temperatura_Observacion = $request->ObservacionTemperatura;
					$HistoriaInicialExamenFisico->Peso_Dato = $request->DatoPeso;
					$HistoriaInicialExamenFisico->Peso_Observacion = $request->ObservacionPeso;
					$HistoriaInicialExamenFisico->Estatura_Dato = $request->DatoEstatura;
					$HistoriaInicialExamenFisico->Estatura_Observacion = $request->ObservacionEstatura;
					$HistoriaInicialExamenFisico->Cabeza_Dato = $request->DatoCabeza;
					$HistoriaInicialExamenFisico->Cabeza_Observacion = $request->ObservacionCabeza;
					$HistoriaInicialExamenFisico->Cuello_Dato = $request->DatoCuello;
					$HistoriaInicialExamenFisico->Cuello_Observacion = $request->ObservacionCuello;
					$HistoriaInicialExamenFisico->Agudeza_Visual_Dato = $request->DatoAgudezaVisual;
					$HistoriaInicialExamenFisico->Oi = $request->OI;
					$HistoriaInicialExamenFisico->Oi = $request->OD;
					$HistoriaInicialExamenFisico->F_De_O = $request->FDEO;
					$HistoriaInicialExamenFisico->Audicion_Dato = $request->DatoAudicion;
					$HistoriaInicialExamenFisico->Audicion_Observacion = $request->ObservacionAudicion;
					$HistoriaInicialExamenFisico->Orl_Dato = $request->DatoOrl;
					$HistoriaInicialExamenFisico->Orl_Observacion = $request->ObservacionOrl;
					$HistoriaInicialExamenFisico->Cavidad_Oral_Dato = $request->DatoCavidadOral;
					$HistoriaInicialExamenFisico->Cavidad_Oral_Observacion = $request->ObservacionCavidadOral;
					$HistoriaInicialExamenFisico->Pulmonar_Dato = $request->DatoPulmonar;
					$HistoriaInicialExamenFisico->Pulmonar_Observacion = $request->ObservacionPulmonar;
					$HistoriaInicialExamenFisico->Cardiaco_Dato = $request->DatoCardiaco;
					$HistoriaInicialExamenFisico->Cardiaco_Observacion = $request->ObservacionCardiaco;
					$HistoriaInicialExamenFisico->Vascular_Periferico_Dato = $request->DatoVascularPeriferico;
					$HistoriaInicialExamenFisico->Vascular_Periferico_Observacion = $request->ObservacionVascularPeriferico;
					$HistoriaInicialExamenFisico->Abdomen_Dato = $request->DatoAbdomen;
					$HistoriaInicialExamenFisico->Abdomen_Observacion = $request->ObservacionAbdomen;
					$HistoriaInicialExamenFisico->Genitourinario_Dato = $request->DatoGenitourinario;
					$HistoriaInicialExamenFisico->Genitourinario_Observacion = $request->ObservacionGenitourinario;
					$HistoriaInicialExamenFisico->Neurologico_Dato = $request->DatoNeurologico;
					$HistoriaInicialExamenFisico->Neurologico_Observacion = $request->ObservacionNeurologico;
					$HistoriaInicialExamenFisico->Piel_Faneras_Dato = $request->DatoPielFaneras;
					$HistoriaInicialExamenFisico->Piel_Faneras_Observacion = $request->ObservacionPielFaneras;
					$HistoriaInicialExamenFisico->Postura_Ap_Dato = $request->DatoAP;
					$HistoriaInicialExamenFisico->Postura_Ap_Observacion = $request->ObservacionAP;
					$HistoriaInicialExamenFisico->Postura_Pa_Dato = $request->DatoPA;
					$HistoriaInicialExamenFisico->Postura_Pa_Observacion = $request->ObservacionPA;
					$HistoriaInicialExamenFisico->Postura_Lateral_Dato = $request->DatoLateral;
					$HistoriaInicialExamenFisico->Postura_Lateral_Observacion = $request->ObservacionLateral;
					$HistoriaInicialExamenFisico->Postura_Cuello_Dato = $request->DatoCuello2;
					$HistoriaInicialExamenFisico->Postura_Cuello_Observacion = $request->ObservacionCuello2;
					$HistoriaInicialExamenFisico->Ms_Hombro_Dato = $request->DatoHombro;
					$HistoriaInicialExamenFisico->Ms_Hombro_Observacion = $request->ObservacionHombro;
					$HistoriaInicialExamenFisico->Ms_Codo_Dato = $request->DatoCodo;
					$HistoriaInicialExamenFisico->Ms_Codo_Observacion = $request->ObservacionCodo;
					$HistoriaInicialExamenFisico->Ms_Muneca_Dato = $request->DatoMuneca;
					$HistoriaInicialExamenFisico->Ms_Muneca_Observacion = $request->ObservacionMuneca;
					$HistoriaInicialExamenFisico->Ms_Mano_Dato = $request->DatoMano;
					$HistoriaInicialExamenFisico->Ms_Mano_Observacion = $request->ObservacionMano;
					$HistoriaInicialExamenFisico->Columna_Cervical_Dato = $request->DatoCervical;
					$HistoriaInicialExamenFisico->Columna_Cervical_Observacion = $request->ObservacionCervical;
					$HistoriaInicialExamenFisico->Columna_Dorsal_Dato = $request->DatoDorsal;
					$HistoriaInicialExamenFisico->Columna_Dorsal_Observacion = $request->ObservacionDorsal;
					$HistoriaInicialExamenFisico->Columna_Lumbosaca_Dato = $request->DatoLumbosaca;
					$HistoriaInicialExamenFisico->Columna_Lumbosaca_Observacion = $request->ObservacionLumbosaca;
					$HistoriaInicialExamenFisico->Mi_Cadera_Dato = $request->DatoCadera;
					$HistoriaInicialExamenFisico->Mi_Cadera_Observacion = $request->ObservacionCadera;
					$HistoriaInicialExamenFisico->Mi_Rodilla_Dato = $request->DatoRodilla;
					$HistoriaInicialExamenFisico->Mi_Rodilla_Observacion = $request->ObservacionRodilla;
					$HistoriaInicialExamenFisico->Mi_Tobillo_Dato = $request->DatoTobillo;
					$HistoriaInicialExamenFisico->Mi_Tobillo_Observacion = $request->ObservacionTobillo;
					$HistoriaInicialExamenFisico->save();
					
	        		return response()->json(['Estado' => 'Success', "Mensaje" => "Consulta registrada con éxito."]);                	
	        	}else{
	        		return response()->json(['Estado' => 'Error', "Mensaje" => "No se logro el registro de la consulta, por favor intentelo más tarde."]);                	
	        	}
	        }
	    }		
	}

	public function ModificarHistoriaInicial(RegistroHistoriaInicial $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), ['FotografiaDep' => 'mimes:jpeg,jpg,png,bmp',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$HistoriaInicial = HistoriaInicial::find($request->historia);
	        	$HistoriaInicial->Deportista_Id = $request->deportista;
	        	$HistoriaInicial->Ocupacion_Id = $request->Ocupacion;
	        	$HistoriaInicial->NivelEstudio_Id = $request->NivelEstudio;
	        	$HistoriaInicial->Dominancia_Id = $request->Dominancia;
	        	$HistoriaInicial->Medico_Id = $_SESSION['Usuario'][0];
	        	$HistoriaInicial->Edad_Deportiva = $request->EdadDeportiva;
	        	$HistoriaInicial->Nombre_Padre = $request->NombrePadre;
	        	$HistoriaInicial->Nombre_Madre = $request->NombreMadre;
	        	$HistoriaInicial->Entrenamiento_Continuo_Preg = $request->EntrenamientoContinuoPreg;
	        	$HistoriaInicial->Plan_Entrenamiento_Preg = $request->PlanEntrenamientoPreg;
	        	$HistoriaInicial->Nombre_Acudiente = $request->NombreAcudiente;
	        	$HistoriaInicial->Telefono_Acudiente = $request->TelefonoAcudiente;
	        	$HistoriaInicial->Nombre_Responsable = $request->NombreResponsable;
	        	$HistoriaInicial->Telefono_Responsable = $request->TelefonoResponsable;


	        	if($HistoriaInicial->save()){
					$HistoriaInicialConsulta = HistoriaInicialConsulta::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialConsulta[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialConsulta[0]->Descripcion = $request->MotivoConsulta;
					$HistoriaInicialConsulta[0]->save();

					$HistoriaInicialOsteomuscular = HistoriaInicialOsteomuscular::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialOsteomuscular[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialOsteomuscular[0]->Descripcion = $request->AntecedenteOsteomusculares;
					$HistoriaInicialOsteomuscular[0]->save();

					$HistoriaInicialPatologico = HistoriaInicialPatologico::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialPatologico[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialPatologico[0]->Descripcion = $request->AntecedentePatologico;
					$HistoriaInicialPatologico[0]->save();

					$HistoriaInicialGinecologico = HistoriaInicialGinecologico::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialGinecologico[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialGinecologico[0]->Menarquia = $request->Menarquia;
					$HistoriaInicialGinecologico[0]->Ciclo = $request->Ciclo;
					$HistoriaInicialGinecologico[0]->Regular = $request->Regular;
					$HistoriaInicialGinecologico[0]->Dismenorrea = $request->Dismenorrea;
					$HistoriaInicialGinecologico[0]->Fum = $request->Fum;
					$HistoriaInicialGinecologico[0]->Fup = $request->Fup;
					$HistoriaInicialGinecologico[0]->G = $request->G;
					$HistoriaInicialGinecologico[0]->P = $request->P;
					$HistoriaInicialGinecologico[0]->V = $request->V;
					$HistoriaInicialGinecologico[0]->A = $request->A;
					$HistoriaInicialGinecologico[0]->Amenorrea = $request->Amenorrea;
					$HistoriaInicialGinecologico[0]->Planifica_Preg = $request->Planifica;
					$HistoriaInicialGinecologico[0]->Metodo_Planificacion = $request->Metodo;
					$HistoriaInicialGinecologico[0]->save();

					$HistoriaInicialResultado = HistoriaInicialResultado::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialResultado[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialResultado[0]->Diagnostico = $request->Diagnostico;
					$HistoriaInicialResultado[0]->Incapacacidad_Provisional = $request->IncapacidadProvisional;
					$HistoriaInicialResultado[0]->Aptitud_Id = $request->Aptitud;
					$HistoriaInicialResultado[0]->Recomendacion_Tratamiento = $request->Recomendaciones;
					$HistoriaInicialResultado[0]->save();

					$HistoriaInicialExamenFisico = HistoriaInicialExamenFisico::where('Historia_Inicial_Id', $request->historia)->get();
					$HistoriaInicialExamenFisico[0]->Historia_Inicial_Id = $HistoriaInicial->Id;
					$HistoriaInicialExamenFisico[0]->Pa_Pie_Dato = $request->DatoPaPie;
					$HistoriaInicialExamenFisico[0]->Pa_Pie_Observacion = $request->ObservacionPaPie;
					$HistoriaInicialExamenFisico[0]->Pa_Supino_Dato = $request->DatoPaSupino;
					$HistoriaInicialExamenFisico[0]->Pa_Supino_Observacion = $request->ObservacionPaSupino;
					$HistoriaInicialExamenFisico[0]->Fc_Reposo_Dato = $request->DatoFCReposo;
					$HistoriaInicialExamenFisico[0]->Fc_Reposo_Observacion = $request->ObservacionFCReposo;
					$HistoriaInicialExamenFisico[0]->Fr_Dato = $request->DatoFR;
					$HistoriaInicialExamenFisico[0]->Fr_Observacion = $request->ObservacionFR;
					$HistoriaInicialExamenFisico[0]->Temperatura_Dato = $request->DatoTemperatura;
					$HistoriaInicialExamenFisico[0]->Temperatura_Observacion = $request->ObservacionTemperatura;
					$HistoriaInicialExamenFisico[0]->Peso_Dato = $request->DatoPeso;
					$HistoriaInicialExamenFisico[0]->Peso_Observacion = $request->ObservacionPeso;
					$HistoriaInicialExamenFisico[0]->Estatura_Dato = $request->DatoEstatura;
					$HistoriaInicialExamenFisico[0]->Estatura_Observacion = $request->ObservacionEstatura;
					$HistoriaInicialExamenFisico[0]->Cabeza_Dato = $request->DatoCabeza;
					$HistoriaInicialExamenFisico[0]->Cabeza_Observacion = $request->ObservacionCabeza;
					$HistoriaInicialExamenFisico[0]->Cuello_Dato = $request->DatoCuello;
					$HistoriaInicialExamenFisico[0]->Cuello_Observacion = $request->ObservacionCuello;
					$HistoriaInicialExamenFisico[0]->Agudeza_Visual_Dato = $request->DatoAgudezaVisual;
					$HistoriaInicialExamenFisico[0]->Oi = $request->OI;
					$HistoriaInicialExamenFisico[0]->Oi = $request->OD;
					$HistoriaInicialExamenFisico[0]->F_De_O = $request->FDEO;
					$HistoriaInicialExamenFisico[0]->Audicion_Dato = $request->DatoAudicion;
					$HistoriaInicialExamenFisico[0]->Audicion_Observacion = $request->ObservacionAudicion;
					$HistoriaInicialExamenFisico[0]->Orl_Dato = $request->DatoOrl;
					$HistoriaInicialExamenFisico[0]->Orl_Observacion = $request->ObservacionOrl;
					$HistoriaInicialExamenFisico[0]->Cavidad_Oral_Dato = $request->DatoCavidadOral;
					$HistoriaInicialExamenFisico[0]->Cavidad_Oral_Observacion = $request->ObservacionCavidadOral;
					$HistoriaInicialExamenFisico[0]->Pulmonar_Dato = $request->DatoPulmonar;
					$HistoriaInicialExamenFisico[0]->Pulmonar_Observacion = $request->ObservacionPulmonar;
					$HistoriaInicialExamenFisico[0]->Cardiaco_Dato = $request->DatoCardiaco;
					$HistoriaInicialExamenFisico[0]->Cardiaco_Observacion = $request->ObservacionCardiaco;
					$HistoriaInicialExamenFisico[0]->Vascular_Periferico_Dato = $request->DatoVascularPeriferico;
					$HistoriaInicialExamenFisico[0]->Vascular_Periferico_Observacion = $request->ObservacionVascularPeriferico;
					$HistoriaInicialExamenFisico[0]->Abdomen_Dato = $request->DatoAbdomen;
					$HistoriaInicialExamenFisico[0]->Abdomen_Observacion = $request->ObservacionAbdomen;
					$HistoriaInicialExamenFisico[0]->Genitourinario_Dato = $request->DatoGenitourinario;
					$HistoriaInicialExamenFisico[0]->Genitourinario_Observacion = $request->ObservacionGenitourinario;
					$HistoriaInicialExamenFisico[0]->Neurologico_Dato = $request->DatoNeurologico;
					$HistoriaInicialExamenFisico[0]->Neurologico_Observacion = $request->ObservacionNeurologico;
					$HistoriaInicialExamenFisico[0]->Piel_Faneras_Dato = $request->DatoPielFaneras;
					$HistoriaInicialExamenFisico[0]->Piel_Faneras_Observacion = $request->ObservacionPielFaneras;
					$HistoriaInicialExamenFisico[0]->Postura_Ap_Dato = $request->DatoAP;
					$HistoriaInicialExamenFisico[0]->Postura_Ap_Observacion = $request->ObservacionAP;
					$HistoriaInicialExamenFisico[0]->Postura_Pa_Dato = $request->DatoPA;
					$HistoriaInicialExamenFisico[0]->Postura_Pa_Observacion = $request->ObservacionPA;
					$HistoriaInicialExamenFisico[0]->Postura_Lateral_Dato = $request->DatoLateral;
					$HistoriaInicialExamenFisico[0]->Postura_Lateral_Observacion = $request->ObservacionLateral;
					$HistoriaInicialExamenFisico[0]->Postura_Cuello_Dato = $request->DatoCuello2;
					$HistoriaInicialExamenFisico[0]->Postura_Cuello_Observacion = $request->ObservacionCuello2;
					$HistoriaInicialExamenFisico[0]->Ms_Hombro_Dato = $request->DatoHombro;
					$HistoriaInicialExamenFisico[0]->Ms_Hombro_Observacion = $request->ObservacionHombro;
					$HistoriaInicialExamenFisico[0]->Ms_Codo_Dato = $request->DatoCodo;
					$HistoriaInicialExamenFisico[0]->Ms_Codo_Observacion = $request->ObservacionCodo;
					$HistoriaInicialExamenFisico[0]->Ms_Muneca_Dato = $request->DatoMuneca;
					$HistoriaInicialExamenFisico[0]->Ms_Muneca_Observacion = $request->ObservacionMuneca;
					$HistoriaInicialExamenFisico[0]->Ms_Mano_Dato = $request->DatoMano;
					$HistoriaInicialExamenFisico[0]->Ms_Mano_Observacion = $request->ObservacionMano;
					$HistoriaInicialExamenFisico[0]->Columna_Cervical_Dato = $request->DatoCervical;
					$HistoriaInicialExamenFisico[0]->Columna_Cervical_Observacion = $request->ObservacionCervical;
					$HistoriaInicialExamenFisico[0]->Columna_Dorsal_Dato = $request->DatoDorsal;
					$HistoriaInicialExamenFisico[0]->Columna_Dorsal_Observacion = $request->ObservacionDorsal;
					$HistoriaInicialExamenFisico[0]->Columna_Lumbosaca_Dato = $request->DatoLumbosaca;
					$HistoriaInicialExamenFisico[0]->Columna_Lumbosaca_Observacion = $request->ObservacionLumbosaca;
					$HistoriaInicialExamenFisico[0]->Mi_Cadera_Dato = $request->DatoCadera;
					$HistoriaInicialExamenFisico[0]->Mi_Cadera_Observacion = $request->ObservacionCadera;
					$HistoriaInicialExamenFisico[0]->Mi_Rodilla_Dato = $request->DatoRodilla;
					$HistoriaInicialExamenFisico[0]->Mi_Rodilla_Observacion = $request->ObservacionRodilla;
					$HistoriaInicialExamenFisico[0]->Mi_Tobillo_Dato = $request->DatoTobillo;
					$HistoriaInicialExamenFisico[0]->Mi_Tobillo_Observacion = $request->ObservacionTobillo;
					$HistoriaInicialExamenFisico[0]->save();
					
	        		return response()->json(['Estado' => 'Success', "Mensaje" => "Esta consulta ha sido modificada con éxito."]);                	
	        	}else{
	        		return response()->json(['Estado' => 'Error', "Mensaje" => "No se logro la modificación de la consulta, por favor intentelo más tarde."]);
	        	}
	        }
	    }
	}

	public function GetEvolucion(Request $request, $id_historia_inicial){
		$HistoriaInicial = HistoriaInicial::with('historiaInicialEvolucion')->find($id_historia_inicial);
		return $HistoriaInicial->historiaInicialEvolucion;

	}

	public function AgregarEvolucion(Request $request){
		if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), ['ObservacionEvolucion' => 'required',]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$HistoriaInicialEvolucion = new HistoriaInicialEvolucion;
	        	$HistoriaInicialEvolucion->Historia_Inicial_Id = $request->Historia_Inicial_Id;
	        	$HistoriaInicialEvolucion->Observacion = $request->ObservacionEvolucion;

	        	if($HistoriaInicialEvolucion->save()){
	        		return response()->json(['Estado' => 'Success', "Mensaje" => "Se ha completado el registro de evolución de esta consulta con éxito."]);
	        	}else{
	        		return response()->json(['Estado' => 'Error', "Mensaje" => "No se logro el registro de la evolución de esta consulta, por favor intentelo más tarde."]);
	        	}
	        }
	    }
	}
}
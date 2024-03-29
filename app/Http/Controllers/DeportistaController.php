<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroDeportista;

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

class DeportistaController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
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
		;
	}

 	public function datos($id){
        $persona = Persona::with('deportista', 'deportista.deportistaValoracion', 'deportista.deportistaValoracion.idioma', 'deportista.deportistaValoracion.quien', 'deportista.deportistaValoracion.preguntaA')->find($id);
        return $persona;
    }

    public function Tallas(Request $request, $Genero_Id, $Tipo_Id){
        if ($request->ajax()) {
            $tallas = TipoTalla::with('tipo_talla', 'tipo_talla.genero')->find($Tipo_Id);
            $talla_genero = $tallas->tipo_talla->whereIn('Genero_Id', [(int)$Genero_Id]);
        }
        
        return($talla_genero);
    }

    public function RegistrarDeportista(RegistroDeportista $request){             		
    	if ($request->ajax()) { 

    		$deportista = new Deportista;
    		$deportista->Persona_Id = $request->Persona;
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

		 	if($deportista->save()){
		 		$deportistaDeporte = new DeportistaDeporte;
			 	$deportistaDeporte->Deportista_Id = $deportista->Id;
			 	$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
			 	$deportistaDeporte->Deporte_Id = $request->Deporte;
			 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;
			 	$deportistaDeporte->Club_Id = $request->Club;
			 	$deportistaDeporte->save();

			 	return response()->json(["Mensaje" => "Deportista registrado con éxito."]);                	
		 	}else{
		 		return response()->json(["Mensaje" => "Se presento una falla, intentelo de nuevo."]);                	
		 	}
    	}
    }

    public function ModificarDeportista(RegistroDeportista $request){    	
    	if ($request->ajax()) { 

    		$DeportistaDeporte = Deportista::with('deportistaDeporte')->find($request->Deportista);
	    	$dep = $DeportistaDeporte->deportistaDeporte[count($DeportistaDeporte->deportistaDeporte)-1];

	    	if($dep['Agrupacion_Id'] != $request->Agrupacion || $dep['Deporte_Id'] != $request->Deporte || $dep['Modalidad_Id'] != $request->Modalidad || $dep['Club_Id'] != $request->Club){	    		
	    		$deportistaDeporte = new DeportistaDeporte;
			 	$deportistaDeporte->Deportista_Id = $request->Deportista;
			 	$deportistaDeporte->Agrupacion_Id = $request->Agrupacion;
			 	$deportistaDeporte->Deporte_Id = $request->Deporte;
			 	$deportistaDeporte->Modalidad_Id = $request->Modalidad;
			 	$deportistaDeporte->Club_Id = $request->Club;
			 	$deportistaDeporte->save();
	    	}

    		$deportista = Deportista::find($request->Deportista);
    		$deportista->Persona_Id = $request->Persona;
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
		 	$deportista->save();

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

}


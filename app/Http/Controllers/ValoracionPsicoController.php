<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use App\Http\Requests\RegistroValoracionPsico;

use App\Models\Genero;
use App\Models\GrupoSanguineo;
use App\Models\Eps;
use App\Models\Etnia;
use App\Models\Ciudad;
use App\Models\Estrato;
use App\Models\Club;
use App\Models\Deporte;
use App\Models\Modalidad;
use App\Models\ValoracionPsico;
use App\Models\PreguntaA;
use App\Models\PreguntaIdioma;
use App\Models\PreguntaQuien;
use App\Models\ValoracionRiesgo;

use Illuminate\Http\Request;

class ValoracionPsicoController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function index()
	{
		$Genero = Genero::all();
		$GrupoSanguineo = GrupoSanguineo::all();
		$Eps = Eps::all();
		$Ciudad = Ciudad::all();
		$Etnia = Etnia::all();
		$Estrato = Estrato::all();
		$Club = Club::All();
		$Deporte = Deporte::all();
		$Modalidad = Modalidad::all();

		$deportista = array();
		return view('SIAB/valoracionPsico',['deportista' => $deportista])
				->with(compact('Genero'))
				->with(compact('GrupoSanguineo'))
				->with(compact('Eps'))
				->with(compact('Ciudad'))
				->with(compact('Etnia'))
				->with(compact('Estrato'))
				->with(compact('Club'))
				->with(compact('Deporte'))
				->with(compact('Modalidad'))
				;
	}

	public function RegistrarValoracion(RegistroValoracionPsico $request){
		//dd($request->all());
		if ($request->ajax()) { 
			$ValoracionPsico  = new ValoracionPsico; 
			$ValoracionPsico->Deportista_Id = $request->deportista;
			$ValoracionPsico->Discapacidad = $request->Discapacidad;
			$ValoracionPsico->EdadInicio = $request->EdadPreg;
			$ValoracionPsico->AniosPractica = $request->PracticaPreg;
			$ValoracionPsico->DesplazamientoPreg = $request->DesplazamientoPreg;
			$ValoracionPsico->Desplazamiento = $request->DesplazamientoDesc;
			$ValoracionPsico->P1 = $request->op1;
			$ValoracionPsico->P2 = $request->op2;
			$ValoracionPsico->P3 = $request->op3;
			$ValoracionPsico->P5 = $request->op5;
			$ValoracionPsico->P6 = $request->op6;
			$ValoracionPsico->P8 = $request->op8;
			$ValoracionPsico->P81 = $request->op81;
			$ValoracionPsico->P82 = $request->op82;
			$ValoracionPsico->P9 = $request->op9;
			$ValoracionPsico->P10 = $request->op10;
			$ValoracionPsico->P11 = $request->op11;
			$ValoracionPsico->P111 = $request->op111;
			$ValoracionPsico->P112 = $request->op112;
			$ValoracionPsico->P113 = $request->op113;
			$ValoracionPsico->P114 = $request->op114;
			$ValoracionPsico->P13 = $request->op13;
			$ValoracionPsico->P15 = $request->op15;
			$ValoracionPsico->P16 = $request->op16;
			$ValoracionPsico->P17 = $request->op17;
			$ValoracionPsico->P19 = $request->op19;
			$ValoracionPsico->P191 = $request->op191;
			$ValoracionPsico->P192 = $request->op192;
			$ValoracionPsico->P193 = $request->op193;		
			$ValoracionPsico->P194 = $request->op194;
			$ValoracionPsico->P195 = $request->op195;
			$ValoracionPsico->P196 = $request->op196;
			$ValoracionPsico->P20 = $request->op20;
			$ValoracionPsico->P21 = $request->op21;
			$ValoracionPsico->P22 = $request->op22;
			$ValoracionPsico->P23 = $request->op23;
			$ValoracionPsico->P24 = $request->op24;
			$ValoracionPsico->P25 = $request->op25;
			$ValoracionPsico->P27 = $request->op27;
			$ValoracionPsico->P29 = $request->op29;
			//$ValoracionPsico->P34 = $request->op34;
			$ValoracionPsico->P35 = $request->op35;
			$ValoracionPsico->P40 = $request->op40;
			$ValoracionPsico->P42 = $request->op42;
			$ValoracionPsico->P43 = $request->op43;
			$ValoracionPsico->P44 = $request->op44;
			$ValoracionPsico->P46 = $request->op46;
			$ValoracionPsico->P49 = $request->op49;
			$ValoracionPsico->P51 = $request->op51;
			$ValoracionPsico->ConceptoProfesional = $request->ConceptoProfesional;

			$ValoracionPsico->save();

			/*******************PREGUNTA 14***********************/
			if($request->op10 == 'Si'){			
				$this->PreguntaA1($ValoracionPsico->Id, 'P14', $request->op14, 'Si', $request->otro14);
			}
			/*****************************************************/

			/*******************PREGUNTA 12***********************/
			if(isset($request->op13)){
				$this->PreguntaA1($ValoracionPsico->Id, 'P12', $request->op12, $request->otro12);
			}
			/*****************************************************/

			/*******************PREGUNTA 26***********************/
		//	$this->PreguntaA1($ValoracionPsico->Id, 'P26', $request->op26, 'Otros', $request->otro26);
			/*****************************************************/
			/*******************PREGUNTA 32***********************/
			$this->PreguntaA1($ValoracionPsico->Id, 'P32', $request->op32, 'Si', $request->otro32);
			/****************************************************/
			/*******************PREGUNTA 33***********************/
			$this->PreguntaA1($ValoracionPsico->Id, 'P33', $request->op33, 'Si', $request->otro33);
			/****************************************************/


			/*******************PREGUNTA 4***********************/
			$contador4 = count($request->op4);
			$i = 0;
			while($i < $contador4){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P4';
				$PreguntaA->Respuesta = $request->op4[$i];
				if($request->op4[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro4;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 26***********************/
			$contador26 = count($request->op26);
			$i = 0;
			while($i < $contador26){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P26';
				$PreguntaA->Respuesta = $request->op26[$i];
				if($request->op26[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro26;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 34***********************/
			$contador34 = count($request->op34);
			$i = 0;
			while($i < $contador34){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P34';
				$PreguntaA->Respuesta = $request->op34[$i];
				if($request->op34[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro34;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/


			/*******************PREGUNTA 7***********************/
			$contador7 = count($request->op7);
			$i = 0;
			while($i < $contador7){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P7';
				$PreguntaA->Respuesta = $request->op7[$i];		
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 41***********************/
			$contador41 = count($request->op41);
			$i = 0;
			while($i < $contador41){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P41';
				$PreguntaA->Respuesta = $request->op41[$i];
				if($request->op41[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro41;
				}	
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 53***********************/
			$contador53 = count($request->op53);
			$i = 0;
			while($i < $contador53){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P53';
				$PreguntaA->Respuesta = $request->op53[$i];

				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 54***********************/
			$contador54 = count($request->op54);
			$i = 0;
			while($i < $contador54){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P54';
				$PreguntaA->Respuesta = $request->op54[$i];
				$PreguntaA->save();

				$i++;
			}

			/*******************PREGUNTA 47***********************/
			$PreguntaA = new PreguntaA;
			$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
			$PreguntaA->PreguntaA_Id = 'P47';
			$PreguntaA->Respuesta = $request->op47;
			if($request->op47 == 'Si'){
				$contador472 = count($request->op472);
				$i = 0;
				while($i < $contador472){
					$PreguntaA2 = new PreguntaA;
					$PreguntaA2->ValoracionA_Id = $ValoracionPsico->Id;
					$PreguntaA2->PreguntaA_Id = 'P472';
					$PreguntaA2->Respuesta = $request->op472[$i];
					if($request->op472[$i] == 'Otras'){
						$PreguntaA2->Descripcion = $request->otro472;
					}	
					$PreguntaA2->save();

					$i++;
				}
			}
			$PreguntaA->save();
			/****************************************************/

			/*******************PREGUNTA 52***********************/
			$PreguntaA = new PreguntaA;
			$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
			$PreguntaA->PreguntaA_Id = 'P52';
			$PreguntaA->Respuesta = $request->op52;
			if($request->op52 == 'Si'){
				$contador522 = count($request->op522);
				$i = 0;
				while($i < $contador522){
					$PreguntaA2 = new PreguntaA;
					$PreguntaA2->ValoracionA_Id = $ValoracionPsico->Id;
					$PreguntaA2->PreguntaA_Id = 'P522';
					$PreguntaA2->Respuesta = $request->op522[$i];
					if($request->op522[$i] == 'Otra'){
						$PreguntaA2->Descripcion = $request->otro522;
					}	
					$PreguntaA2->save();

					$i++;
				}
			}
			$PreguntaA->save();
			/****************************************************/



			

	       /*******************PREGUNTA 28-1***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P281', $request->op281, $request->otro281);
			/*****************************************************/
			/*******************PREGUNTA 28-2***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P282', $request->op282, $request->otro282);
			/*****************************************************/
			/*******************PREGUNTA 28-3***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P283', $request->op283, $request->otro283);
			/*****************************************************/
			/*******************PREGUNTA 28-4***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P284', $request->op284, $request->otro284);
			/*****************************************************/
			/*******************PREGUNTA 28-5***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P285', $request->op285, $request->otro285);
			/*****************************************************/
			/*******************PREGUNTA 28-6***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P286', $request->op286, $request->otro286);
			/*****************************************************/
			/*******************PREGUNTA 28-7***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P287', $request->op287, $request->otro287);
			/*****************************************************/
			/*******************PREGUNTA 28-8***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P288', $request->op288, $request->otro288);
			/*****************************************************/


	       	

	       	/*******************PREGUNTA 30***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P30', $request->op30, $request->otro30);
			/*****************************************************/

			
	       /*********************PREGUNTA 31 ***************/
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P311', $request->op311b, $request->op311a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P312', $request->op312b, $request->op312a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P313', $request->op313b, $request->op313a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P314', $request->op314b, $request->op314a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P315', $request->op315b, $request->op315a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P316', $request->op316b, $request->op316a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P317', $request->op317b, $request->op317a);
	   		/**************************************************/

	   		/*******************PREGUNTA 36***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P36', $request->op36, $request->otro36);
			/*****************************************************/
			/*******************PREGUNTA 37***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P37', $request->op37, $request->otro37);
			/*****************************************************/
			/*******************PREGUNTA 38***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P38', $request->op38, $request->otro38);
			/*****************************************************/
			/*******************PREGUNTA 39***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P39', $request->op39, $request->otro39);
			/*****************************************************/
			/*******************PREGUNTA 45***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P45', $request->op45, $request->otro45);
			/*****************************************************/
			/*******************PREGUNTA 48***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P48', $request->op48, $request->otro48);
			/*****************************************************/
			/*******************PREGUNTA 50***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P50', $request->op50, $request->otro50);
			/*****************************************************/

			/**************************************************/
			$idiomas = json_decode($request['vector_idiomas']);
	       	foreach($idiomas as $idiomasV){
	       		$PIdioma = new  PreguntaIdioma;
	       		$PIdioma->ValoracionI_Id = $ValoracionPsico->Id;
	       		$PIdioma->Idioma = $idiomasV->Idioma;
	       		$PIdioma->Habla = $idiomasV->Habla;
	       		$PIdioma->Lee = $idiomasV->Lee;
	       		$PIdioma->Escribe = $idiomasV->Escribe;
	       		$PIdioma->save();
	       	}
	       	/**************************************************/
			$quien = json_decode($request['vector_quien']);
	       	foreach($quien as $quienV){
	       		$PQuien = new  PreguntaQuien;
	       		$PQuien->ValoracionQ_Id = $ValoracionPsico->Id;
	       		$PQuien->Quien = $quienV->Quien29;
	       		$PQuien->Razon = $quienV->Razon29;
	       		$PQuien->save();
	       	}
	       	/**************************************************/

	       	/**************************************************/
	       	$riesgos = json_decode($request['vector_riesgo']);
			if(count($riesgos) != 0){
				foreach($riesgos as $riesgosV){
					$ValoracionRiesgo = new ValoracionRiesgo;
					$ValoracionRiesgo->Valoracion_Id = $ValoracionPsico->Id;
					$ValoracionRiesgo->Factor = $riesgosV->Factor;
					$ValoracionRiesgo->Objetivo = $riesgosV->Objetivo;
					$ValoracionRiesgo->Intervencion = $riesgosV->Intervencion;
					$ValoracionRiesgo->Fecha_Inicio = $riesgosV->Fecha_Inicio;
					$ValoracionRiesgo->Fecha_Fin = $riesgosV->Fecha_Fin;
					$ValoracionRiesgo->Responsable = $riesgosV->Responsable;
					$ValoracionRiesgo->Autorizado = $riesgosV->Autorizada;
					$ValoracionRiesgo->Seguimiento = $riesgosV->Seguimiento;
					$ValoracionRiesgo->Observacion = $riesgosV->Observacion;
					$ValoracionRiesgo->Anexo1 = 'ejm';
					$ValoracionRiesgo->Anexo2 = 'ejm2';
					$ValoracionRiesgo->save();
		       	}
			}
			/**************************************************/

			return response()->json(["Mensaje" => "Valoración Psicosocial registrada con éxito!"]);
		}else{
			return response()->json(["Sin acceso"]);
		}		
	}


	public function PreguntaA1($ValoracionA_Id, $PreguntaA_Id, $Respuesta, $Valor, $Descripcion){
		$PreguntaA = new PreguntaA;
		$PreguntaA->ValoracionA_Id = $ValoracionA_Id;
		$PreguntaA->PreguntaA_Id = $PreguntaA_Id;
		$PreguntaA->Respuesta = $Respuesta;
		if($Respuesta == $Valor){
			$PreguntaA->Descripcion = $Descripcion;
		}
		$PreguntaA->save();
	}

	public function PreguntaB($ValoracionA_Id, $PreguntaA_Id, $Respuesta, $Descripcion){
		$PreguntaA = new PreguntaA;
		$PreguntaA->ValoracionA_Id = $ValoracionA_Id;
		$PreguntaA->PreguntaA_Id = $PreguntaA_Id;
		$PreguntaA->Respuesta = $Respuesta;
		$PreguntaA->Descripcion = $Descripcion;
		$PreguntaA->save();
	}

	public function PreguntaA2($ValoracionA_Id, $PreguntaA_Id, $Respuesta, $Descripcion){
		$PreguntaA = new PreguntaA;
		$PreguntaA->ValoracionA_Id = $ValoracionA_Id;
		$PreguntaA->PreguntaA_Id = $PreguntaA_Id;
		$PreguntaA->Respuesta = $Respuesta;
		$PreguntaA->Descripcion = $Descripcion;
		$PreguntaA->save();
	}

	public function ModificarValoracion(RegistroValoracionPsico $request){


		if ($request->ajax()) { 
			$ValoracionPsico  = ValoracionPsico::with('preguntaA', 'idioma', 'quien', 'valoracionRiesgo' )->find($request->valoracion); 
			$ValoracionPsico->PreguntaA()->forceDelete();
			$ValoracionPsico->idioma()->forceDelete();
			$ValoracionPsico->quien()->forceDelete();
			$ValoracionPsico->valoracionRiesgo()->forceDelete();


			$ValoracionPsico->Deportista_Id = $request->deportista;
			$ValoracionPsico->Discapacidad = $request->Discapacidad;
			$ValoracionPsico->EdadInicio = $request->EdadPreg;
			$ValoracionPsico->AniosPractica = $request->PracticaPreg;
			$ValoracionPsico->DesplazamientoPreg = $request->DesplazamientoPreg;
			$ValoracionPsico->Desplazamiento = $request->DesplazamientoDesc;
			$ValoracionPsico->P1 = $request->op1;
			$ValoracionPsico->P2 = $request->op2;
			$ValoracionPsico->P3 = $request->op3;
			$ValoracionPsico->P5 = $request->op5;
			$ValoracionPsico->P6 = $request->op6;
			$ValoracionPsico->P8 = $request->op8;
			$ValoracionPsico->P81 = $request->op81;
			$ValoracionPsico->P82 = $request->op82;
			$ValoracionPsico->P9 = $request->op9;
			$ValoracionPsico->P10 = $request->op10;
			$ValoracionPsico->P11 = $request->op11;
			$ValoracionPsico->P111 = $request->op111;
			$ValoracionPsico->P112 = $request->op112;
			$ValoracionPsico->P113 = $request->op113;
			$ValoracionPsico->P114 = $request->op114;
			$ValoracionPsico->P13 = $request->op13;
			$ValoracionPsico->P15 = $request->op15;
			$ValoracionPsico->P16 = $request->op16;
			$ValoracionPsico->P17 = $request->op17;
			$ValoracionPsico->P19 = $request->op19;
			$ValoracionPsico->P191 = $request->op191;
			$ValoracionPsico->P192 = $request->op192;
			$ValoracionPsico->P193 = $request->op193;		
			$ValoracionPsico->P194 = $request->op194;
			$ValoracionPsico->P195 = $request->op195;
			$ValoracionPsico->P196 = $request->op196;
			$ValoracionPsico->P20 = $request->op20;
			$ValoracionPsico->P21 = $request->op21;
			$ValoracionPsico->P22 = $request->op22;
			$ValoracionPsico->P23 = $request->op23;
			$ValoracionPsico->P24 = $request->op24;
			$ValoracionPsico->P25 = $request->op25;
			$ValoracionPsico->P27 = $request->op27;
			$ValoracionPsico->P29 = $request->op29;
			//$ValoracionPsico->P34 = $request->op34;
			$ValoracionPsico->P35 = $request->op35;
			$ValoracionPsico->P40 = $request->op40;
			$ValoracionPsico->P42 = $request->op42;
			$ValoracionPsico->P43 = $request->op43;
			$ValoracionPsico->P44 = $request->op44;
			$ValoracionPsico->P46 = $request->op46;
			$ValoracionPsico->P49 = $request->op49;
			$ValoracionPsico->P51 = $request->op51;
			$ValoracionPsico->ConceptoProfesional = $request->ConceptoProfesional;
			$ValoracionPsico->save();

			/*******************PREGUNTA 14***********************/
			if($request->op10 == 'Si'){			
				$this->PreguntaA1($ValoracionPsico->Id, 'P14', $request->op14, 'Si', $request->otro14);
			}
			/*****************************************************/

			/*******************PREGUNTA 12***********************/
			if(isset($request->op13)){
				$this->PreguntaA1($ValoracionPsico->Id, 'P12', $request->op12, $request->otro12);
			}
			/*****************************************************/

			/*******************PREGUNTA 26***********************/
			//$this->PreguntaA1($ValoracionPsico->Id, 'P26', $request->op26, 'Otros', $request->otro26);
			/*****************************************************/
			/*******************PREGUNTA 32***********************/
			$this->PreguntaA1($ValoracionPsico->Id, 'P32', $request->op32, 'Si', $request->otro32);
			/****************************************************/
			/*******************PREGUNTA 33***********************/
			$this->PreguntaA1($ValoracionPsico->Id, 'P33', $request->op33, 'Si', $request->otro33);
			/****************************************************/


			/*******************PREGUNTA 4***********************/
			$contador4 = count($request->op4);
			$i = 0;
			while($i < $contador4){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P4';
				$PreguntaA->Respuesta = $request->op4[$i];
				if($request->op4[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro4;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 4***********************/
			$contador26 = count($request->op26);
			$i = 0;
			while($i < $contador26){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P26';
				$PreguntaA->Respuesta = $request->op26[$i];
				if($request->op26[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro26;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 34***********************/
			$contador34 = count($request->op34);
			$i = 0;
			while($i < $contador34){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P34';
				$PreguntaA->Respuesta = $request->op34[$i];
				if($request->op34[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro34;
				}			
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 7***********************/
			$contador7 = count($request->op7);
			$i = 0;
			while($i < $contador7){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P7';
				$PreguntaA->Respuesta = $request->op7[$i];		
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 41***********************/
			$contador41 = count($request->op41);
			$i = 0;
			while($i < $contador41){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P41';
				$PreguntaA->Respuesta = $request->op41[$i];
				if($request->op41[$i] == 'Otros'){
					$PreguntaA->Descripcion = $request->otro41;
				}	
				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 53***********************/
			$contador53 = count($request->op53);
			$i = 0;
			while($i < $contador53){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P53';
				$PreguntaA->Respuesta = $request->op53[$i];

				$PreguntaA->save();

				$i++;
			}
			/****************************************************/

			/*******************PREGUNTA 54***********************/
			$contador54 = count($request->op54);
			$i = 0;
			while($i < $contador54){
				$PreguntaA = new PreguntaA;
				$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
				$PreguntaA->PreguntaA_Id = 'P54';
				$PreguntaA->Respuesta = $request->op54[$i];
				$PreguntaA->save();

				$i++;
			}

			/*******************PREGUNTA 47***********************/
			$PreguntaA = new PreguntaA;
			$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
			$PreguntaA->PreguntaA_Id = 'P47';
			$PreguntaA->Respuesta = $request->op47;
			if($request->op47 == 'Si'){
				$contador472 = count($request->op472);
				$i = 0;
				while($i < $contador472){
					$PreguntaA2 = new PreguntaA;
					$PreguntaA2->ValoracionA_Id = $ValoracionPsico->Id;
					$PreguntaA2->PreguntaA_Id = 'P472';
					$PreguntaA2->Respuesta = $request->op472[$i];
					if($request->op472[$i] == 'Otras'){
						$PreguntaA2->Descripcion = $request->otro472;
					}	
					$PreguntaA2->save();

					$i++;
				}
			}
			$PreguntaA->save();
			/****************************************************/

			/*******************PREGUNTA 52***********************/
			$PreguntaA = new PreguntaA;
			$PreguntaA->ValoracionA_Id = $ValoracionPsico->Id;
			$PreguntaA->PreguntaA_Id = 'P52';
			$PreguntaA->Respuesta = $request->op52;
			if($request->op52 == 'Si'){
				$contador522 = count($request->op522);
				$i = 0;
				while($i < $contador522){
					$PreguntaA2 = new PreguntaA;
					$PreguntaA2->ValoracionA_Id = $ValoracionPsico->Id;
					$PreguntaA2->PreguntaA_Id = 'P522';
					$PreguntaA2->Respuesta = $request->op522[$i];
					if($request->op522[$i] == 'Otra'){
						$PreguntaA2->Descripcion = $request->otro522;
					}	
					$PreguntaA2->save();

					$i++;
				}
			}
			$PreguntaA->save();
			/****************************************************/



			

	       /*******************PREGUNTA 28-1***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P281', $request->op281, $request->otro281);
			/*****************************************************/
			/*******************PREGUNTA 28-2***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P282', $request->op282, $request->otro282);
			/*****************************************************/
			/*******************PREGUNTA 28-3***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P283', $request->op283, $request->otro283);
			/*****************************************************/
			/*******************PREGUNTA 28-4***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P284', $request->op284, $request->otro284);
			/*****************************************************/
			/*******************PREGUNTA 28-5***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P285', $request->op285, $request->otro285);
			/*****************************************************/
			/*******************PREGUNTA 28-6***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P286', $request->op286, $request->otro286);
			/*****************************************************/
			/*******************PREGUNTA 28-7***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P287', $request->op287, $request->otro287);
			/*****************************************************/
			/*******************PREGUNTA 28-8***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P288', $request->op288, $request->otro288);
			/*****************************************************/


	       	

	       	/*******************PREGUNTA 30***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P30', $request->op30, $request->otro30);
			/*****************************************************/

			
	       /*********************PREGUNTA 31 ***************/
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P311', $request->op311b, $request->op311a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P312', $request->op312b, $request->op312a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P313', $request->op313b, $request->op313a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P314', $request->op314b, $request->op314a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P315', $request->op315b, $request->op315a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P316', $request->op316b, $request->op316a);
	       	$this->PreguntaA2($ValoracionPsico->Id, 'P317', $request->op317b, $request->op317a);
	   		/**************************************************/

	   		/*******************PREGUNTA 36***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P36', $request->op36, $request->otro36);
			/*****************************************************/
			/*******************PREGUNTA 37***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P37', $request->op37, $request->otro37);
			/*****************************************************/
			/*******************PREGUNTA 38***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P38', $request->op38, $request->otro38);
			/*****************************************************/
			/*******************PREGUNTA 39***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P39', $request->op39, $request->otro39);
			/*****************************************************/
			/*******************PREGUNTA 45***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P45', $request->op45, $request->otro45);
			/*****************************************************/
			/*******************PREGUNTA 48***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P48', $request->op48, $request->otro48);
			/*****************************************************/
			/*******************PREGUNTA 50***********************/
			$this->PreguntaB($ValoracionPsico->Id, 'P50', $request->op50, $request->otro50);
			/*****************************************************/

			/**************************************************/
			$idiomas = json_decode($request['vector_idiomas']);
	       	foreach($idiomas as $idiomasV){
	       		$PIdioma = new  PreguntaIdioma;
	       		$PIdioma->ValoracionI_Id = $ValoracionPsico->Id;
	       		$PIdioma->Idioma = $idiomasV->Idioma;
	       		$PIdioma->Habla = $idiomasV->Habla;
	       		$PIdioma->Lee = $idiomasV->Lee;
	       		$PIdioma->Escribe = $idiomasV->Escribe;
	       		$PIdioma->save();
	       	}
	       	/**************************************************/
			$quien = json_decode($request['vector_quien']);
	       	foreach($quien as $quienV){
	       		$PQuien = new  PreguntaQuien;
	       		$PQuien->ValoracionQ_Id = $ValoracionPsico->Id;
	       		$PQuien->Quien = $quienV->Quien29;
	       		$PQuien->Razon = $quienV->Razon29;
	       		$PQuien->save();
	       	}
	       	/**************************************************/

	       	/**************************************************/
	       	$riesgos = json_decode($request['vector_riesgo']);
			if(count($riesgos) != 0){
				foreach($riesgos as $riesgosV){
					$ValoracionRiesgo = new ValoracionRiesgo;
					$ValoracionRiesgo->Valoracion_Id = $ValoracionPsico->Id;
					$ValoracionRiesgo->Factor = $riesgosV->Factor;
					$ValoracionRiesgo->Objetivo = $riesgosV->Objetivo;
					$ValoracionRiesgo->Intervencion = $riesgosV->Intervencion;
					$ValoracionRiesgo->Fecha_Inicio = $riesgosV->Fecha_Inicio;
					$ValoracionRiesgo->Fecha_Fin = $riesgosV->Fecha_Fin;
					$ValoracionRiesgo->Responsable = $riesgosV->Responsable;
					$ValoracionRiesgo->Autorizado = $riesgosV->Autorizada;
					$ValoracionRiesgo->Seguimiento = $riesgosV->Seguimiento;
					$ValoracionRiesgo->Observacion = $riesgosV->Observacion;
					$ValoracionRiesgo->Anexo1 = 'ejm';
					$ValoracionRiesgo->Anexo2 = 'ejm2';
					$ValoracionRiesgo->save();
		       	}
			}
			/**************************************************/




			
			return response()->json(["Mensaje" => "Valoración Psicosocial registrada con éxito!"]);
		}else{
			return response()->json(["Sin acceso"]);
		}		
	}

}





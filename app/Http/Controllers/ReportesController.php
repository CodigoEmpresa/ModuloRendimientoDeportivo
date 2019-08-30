<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Entrenador;

class ReportesController extends Controller
{
    public function __construct(PersonaInterface $repositorio_personas){
        if (isset($_SESSION['Usuario']))
            $this->Usuario = $_SESSION['Usuario'];

        $this->repositorio_personas = $repositorio_personas;
    }

    public function indexTotalDeportistas(){
        return view('REPORTES/totalDeportista');
    }

    public function GetTotalDeportistas(Request $request){

        $Deportista = Deportista::with('persona', 'persona.genero', 'deportistaDeporte.agrupacion', 'deportistaDeporte.deporte', 'deportistaDeporte.modalidad', 'ClasificacionDeportista')->get();
        //dd($Deportista);

        $html = '<span>Número de deportistas <label>'.count($Deportista).'</label></span>';
        $html .= '<table id="deportistasTabla" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">';
        $html .= '<thead>';
        $html .= '<th>Nombres</th>';
        $html .= '<th style="display:none;">Id</th>';
        $html .= '<th style="display:none;">Documento</th>';
        $html .= '<th style="display:none;">Correo</th>';
        $html .= '<th style="display:none;">Genero</th>';
        $html .= '<th style="display:none;">Eps</th>';
        $html .= '<th style="display:none;">Celular</th>';
        $html .= '<th>Clasificación</th>';
        $html .= '<th>Agrupacion</th>';
        $html .= '<th>Deporte</th>';
        $html .= '<th>Modalidad</th>';
        $html .= '<th style="display:none;">Pertenece</th>';
        $html .= '<th style="display:none;">Etapa Nacional</th>';
        $html .= '<th style="display:none;">Etapa Internacional</th>';
        $html .= '</thead>';
        $html .= '<tbody>';     

        foreach ($Deportista as $key => $value) {           

            $Etapas = Deportista::with('deportistaEtapa')->find($value['Id']);
            $Nacional = $Etapas->deportistaEtapa()->whereIn('Tipo_Etapa_id', [1, 3])->orderBy('deportista_etapa.created_at', 'desc')->first();
            $Internacional = $Etapas->deportistaEtapa()->whereIn('Tipo_Etapa_id', [2, 4])->orderBy('deportista_etapa.created_at', 'desc')->first();

            $m = count($value->deportistaDeporte);
            $html .= '<tr>';
            $html .= '<td>'.$value->persona['Primer_Nombre'].' '.$value->persona['Segundo_Nombre'].' '.$value->persona['Primer_Apellido'].' '.$value->persona['Segundo_Apellido'].'</td>';
            $html .= '<td style="display:none;">'.$value['Id'].'</td>';
            $html .= '<td style="display:none;">'.$value->persona['Cedula'].'</td>';
            $html .= '<td style="display:none;">'.$value['Correo_Electronico'].'</td>';
            $html .= '<td style="display:none;">'.$value->persona->genero['Nombre_Genero'].'</td>';
            $html .= '<td style="display:none;">'.$value->Eps['Nombre_Eps'].'</td>';
            $html .= '<td style="display:none;">'.$value['Celular_Localiza'].'</td>';
            $html .= '<td >'.$value->ClasificacionDeportista['Nombre_Clasificacion_Deportista'].'</td>';
            if($m > 0){
                $html .= '<td>'.$value->deportistaDeporte[$m-1]->agrupacion['Nombre_Agrupacion'].'</td>';
                $html .= '<td>'.$value->deportistaDeporte[$m-1]->deporte['Nombre_Deporte'].'</td>';
                $html .= '<td>'.$value->deportistaDeporte[$m-1]->modalidad['Nombre_Modalidad'].'</td>';
            }else{
                $html .= '<td>NO TIENE</td>';
                $html .= '<td>NO TIENE</td>';
                $html .= '<td>NO TIENE</td>';
            }
            if($value['Pertenece'] == 1){
                $html .= '<td >SI</td>';
            }else{
                $html .= '<td >NO</td>';
            }

            $html .= '<td style="display:none;">'.$Nacional['Nombre_Etapa'].'</td>';
            $html .= '<td style="display:none;">'.$Internacional['Nombre_Etapa'].'</td>';
            
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '<table>';
        return $html;
    }

    public function indexTotalEntrenadores(){
        return view('REPORTES/totalEntrenador');
    }

     public function GetTotalEntrenadores(Request $request){

        $Entrenadores = Entrenador::with('persona', 'persona.genero', 'deporte', 'modalidad', 'clasificacionDeportiva', 'ciudadLugar', 'parentesco', 'departamentoLoc', 'regimen', 'tipoAfiliacion', 'nivelRegimenSub', 'fondoPension', 'grupoSanguineo', 'arl')->get();

        $html = '<span>Número de entrenadores <label>'.count($Entrenadores).'</label></span>';
        $html .= '<table id="entrenadoresTabla" class="display nowrap" cellspacing="0" width="100%" style="text-transform: uppercase;">';
        $html .= '<thead>';
        $html .= '<th>Id</th>';
        $html .= '<th>Nombres</th>';
        $html .= '<th>Documento</th>';
        $html .= '<th style="display:none;">Lugar de expedición</th>';
        $html .= '<th style="display:none;">Fecha de expedición</th>';
        $html .= '<th style="display:none;">Correo</th>';
        $html .= '<th style="display:none;">Genero</th>';
        $html .= '<th style="display:none;">Eps</th>';
        $html .= '<th>Clasificación del entrenador</th>';
        $html .= '<th>Clasificación</th>';
        $html .= '<th>Deporte</th>';
        $html .= '<th>Modalidad</th>';

        $html .= '<th style="display:none;">Número de pasaporte</th>';
        $html .= '<th style="display:none;">Fecha del pasaporte</th>';
        $html .= '<th style="display:none;">Libreta militar</th>';
        $html .= '<th style="display:none;">Distrito libreta</th>';
        $html .= '<th style="display:none;">Parentesco del contacto</th>';
        $html .= '<th style="display:none;">Nombre contacto</th>';
        $html .= '<th style="display:none;">Telefono fijo del contacto</th>';
        $html .= '<th style="display:none;">Telefono Celular del contacto</th>';
        $html .= '<th style="display:none;">Departamento de residencia</th>';
        $html .= '<th style="display:none;">Ciudad de residencia</th>';
        $html .= '<th style="display:none;">Direcciòn de residencia</th>';
        $html .= '<th style="display:none;">Barrio de residencia</th>';
        $html .= '<th style="display:none;">Localidad de residencia</th>';
        $html .= '<th style="display:none;">Telefono fijo residencia</th>';
        $html .= '<th style="display:none;">Telefono Celular residencia</th>';
        $html .= '<th style="display:none;">Regimen de salud</th>';
        $html .= '<th style="display:none;">Fecha de afiliación</th>';
        $html .= '<th style="display:none;">Tipo de afiliación</th>';
        $html .= '<th style="display:none;">Medicina prepago</th>';
        $html .= '<th style="display:none;">ARL</th>';
        $html .= '<th style="display:none;">Fondo de pensiones</th>';
        $html .= '<th style="display:none;">Grupo sanguineo</th>';
        $html .= '<th style="display:none;">Uso de medicamento y tiempo</th>';
        $html .= '</thead>';
        $html .= '<tbody>';     

        foreach ($Entrenadores as $key => $value) {           
            $html .= '<tr>';
            $html .= '<td>'.$value['Id'].'</td>';
            $html .= '<td>'.$value->persona['Primer_Nombre'].' '.$value->persona['Segundo_Nombre'].' '.$value->persona['Primer_Apellido'].' '.$value->persona['Segundo_Apellido'].'</td>';
            $html .= '<td>'.$value->persona['Cedula'].'</td>';
            $html .= '<td style="display:none;">'.$value->ciudadLugar['Nombre_Ciudad'].'</td>';
            $html .= '<td style="display:none;">'.$value['Fecha_Expedicion'].'</td>';
            $html .= '<td style="display:none;">'.$value['Correo_Electronico'].'</td>';
            $html .= '<td style="display:none;">'.$value->persona->genero['Nombre_Genero'].'</td>';
            $html .= '<td style="display:none;">'.$value->Eps['Nombre_Eps'].'</td>';

            if($value['Perfeccionamiento'] == 1 && $value['Rendimiento'] == 1){
                 $ClasificacionEntrenador = 'Perfeccionamiento y Rendimiento';
            }else{
                if($value['Perfeccionamiento'] == 1){
                     $ClasificacionEntrenador = 'Perfeccionamiento';
                }
                if($value['Rendimiento'] == 1){
                    $ClasificacionEntrenador = 'Rendimiento';                
                }
            }
            $html .= '<td>'.$ClasificacionEntrenador.'</td>';
            $html .= '<td >'.$value->clasificacionDeportiva['Nombre_Clasificacion_Deportista'].'</td>';
            $html .= '<td >'.$value->deporte['Nombre_Deporte'].'</td>';
            $html .= '<td >'.$value->modalidad['Nombre_Modalidad'].'</td>';

            $html .= '<td style="display:none;">'.$value['Numero_Pasaporte'].'</td>';
            $html .= '<td style="display:none;">'.$value['Fecha_Pasaporte'].'</td>';

            if($value['Libreta_Preg'] == 1){
                $Libreta = $value['Numero_Libreta_Mil'];
                $Distrito = $value['Distrito_Libreta_Mil'];
            }else{
                $Libreta = "No tiene";
                $Distrito = "No tiene";
            }

            $html .= '<td style="display:none;">'.$Libreta.'</td>';
            $html .= '<td style="display:none;">'.$Distrito.'</td>';

            $html .= '<td style="display:none;">'.$value->parentesco['Nombre_Parentesco'].'</td>';
            $html .= '<td style="display:none;">'.$value['Nombre_Contacto'].'</td>';
            $html .= '<td style="display:none;">'.$value['Fijo_Contacto'].'</td>';
            $html .= '<td style="display:none;">'.$value['Celular_Contacto'].'</td>';
            $html .= '<td style="display:none;">'.$value->departamentoLoc['Nombre_Departamento'].'</td>';
            $html .= '<td style="display:none;">'.$value->ciudadLoc['Nombre_Ciudad'].'</td>';
            $html .= '<td style="display:none;">'.$value['Direccion_Localiza'].'</td>';
            $html .= '<td style="display:none;">'.$value['Barrio_Localiza'].'</td>';
            $html .= '<td style="display:none;">'.$value->localidadLoc['Nombre_Localidad'].'</td>';
            $html .= '<td style="display:none;">'.$value['Fijo_Localiza'].'</td>';
            $html .= '<td style="display:none;">'.$value['Celular_Localiza'].'</td>';
            $html .= '<td style="display:none;">'.$value->regimen['Nombre_Regimen_Salud'].'</td>';
            $html .= '<td style="display:none;">'.$value['Fecha_Afiliacion'].'</td>';
            $html .= '<td style="display:none;">'.$value->tipoAfiliacion['Nombre_Tipo_Afiliacion'].'</td>';

            if($value['Medicina_Prepago'] == 1){
                $MedicinaPrepago = $value['Nombre_MedicinaPrepago'];
            }else{
                $MedicinaPrepago = "No Aplica";
            }

            $html .= '<td style="display:none;">'.$MedicinaPrepago.'</td>';

              if($value['Riesgo_Laboral'] == 1){
                $Arl = $value->arl['Nombre_Arl'];
            }else{
                $Arl = "No Aplica";
            }

            $html .= '<td style="display:none;">'.$Arl.'</td>';

            if($value['Fondo_PensionPreg_Id'] == 1){
                $FondoPension = $value->fondoPension['Nombre_Fondo_Pension'];
            }else{
                $FondoPension = "No Tiene";
            }

            $html .= '<td style="display:none;">'.$FondoPension.'</td>';
            $html .= '<td style="display:none;">'.$value->grupoSanguineo['Nombre_GrupoSanguineo'].'</td>';

            if($value['Uso_Medicamento'] == 1){
                $Medicamento = $value['Medicamento']." - ".$value['Tiempo_Medicamento'];
            }else{
                $Medicamento = "No Aplica";
            }

            $html .= '<td style="display:none;">'.$Medicamento.'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '<table>';
        return $html;
    }
}
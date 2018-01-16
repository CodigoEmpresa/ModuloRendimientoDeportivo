<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Models\Deportista;

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
}
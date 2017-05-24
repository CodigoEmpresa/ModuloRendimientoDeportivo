<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroHistoriaInicial extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validaciones = [       
                        "persona" => "required",
                        "deportista" => "required",
                        "Ocupacion" => "required",
                        "NivelEstudio" => "required",
                        "Dominancia" => "required",
                        "NombreMadre" => "required",
                        "NombrePadre" => "required",
                        "EdadDeportiva" => "required",
                        "EntrenamientoContinuoPreg" => "required",
                        "PlanEntrenamientoPreg" => "required",
                        "NombreAcudiente" => "required",
                        "TelefonoAcudiente" => "required",
                        "NombreResponsable" => "required",
                        "TelefonoResponsable" => "required",
                        "MotivoConsulta" => "required",
                        "AntecedentePatologico" => "required",
                        "AntecedenteOsteomusculares" => "required",
                        "Menarquia" => "required",
                        "Ciclo" => "required",
                        "Regular" => "required",
                        "Dismenorrea" => "required",
                        "Fum" => "required",
                        "Fup" => "required",
                        "G" => "required",
                        "P" => "required",
                        "V" => "required",
                        "A" => "required",
                        "Amenorrea" => "required",
                        "Planifica" => "required",
                        "Metodo" => array('required_if:Planifica,1'),
                        "DatoPaPie" => "required",
                        "ObservacionPaPie" => "required",
                        "DatoPaSupino" => "required",
                        "ObservacionPaSupino" => "required",
                        "DatoFCReposo" => "required",
                        "ObservacionFCReposo" => "required",
                        "DatoFR" => "required",
                        "ObservacionFR" => "required",
                        "DatoTemperatura" => "required",
                        "ObservacionTemperatura" => "required",
                        "DatoPeso" => "required",
                        "ObservacionPeso" => "required",
                        "DatoEstatura" => "required",
                        "ObservacionEstatura" => "required",

                        "DatoCabeza" => "required",
                        "ObservacionCabeza" => array('required_if:DatoCabeza,2'),
                        "DatoCuello" => "required",
                        "ObservacionCuello" => array('required_if:DatoCuello,2'),
                        "DatoAgudezaVisual" => "required",
                        "OI" => array('required_if:DatoAgudezaVisual,2'),
                        "OD" => array('required_if:DatoAgudezaVisual,2'),
                        "FDEO" => array('required_if:DatoAgudezaVisual,2'),
                        "DatoAudicion" => "required",
                        "ObservacionAudicion" => array('required_if:DatoAudicion,2'),
                        "DatoOrl" => "required",
                        "ObservacionOrl" => array('required_if:DatoOrl,2'),
                        "DatoCavidadOral" => "required",
                        "ObservacionCavidadOral" => array('required_if:DatoCavidadOral,2'),
                        "DatoPulmonar" => "required",
                        "ObservacionPulmonar" => array('required_if:DatoPulmonar,2'),
                        "DatoCardiaco" => "required",
                        "ObservacionCardiaco" => array('required_if:DatoCardiaco,2'),
                        "DatoVascularPeriferico" => "required",
                        "ObservacionVascularPeriferico" => array('required_if:DatoVascularPeriferico,2'),
                        "DatoAbdomen" => "required",
                        "ObservacionAbdomen" => array('required_if:DatoAbdomen,2'),
                        "DatoGenitourinario" => "required",
                        "ObservacionGenitourinario" => array('required_if:DatoGenitourinario,2'),
                        "DatoNeurologico" => "required",
                        "ObservacionNeurologico" => array('required_if:DatoNeurologico,2'),
                        "DatoPielFaneras" => "required",
                        "ObservacionPielFaneras" => array('required_if:DatoPielFaneras,2'),
                        "DatoAP" => "required",
                        "ObservacionAP" => array('required_if:DatoAP,2'),
                        "DatoPA" => "required",
                        "ObservacionPA" => array('required_if:DatoPA,2'),
                        "DatoLateral" => "required",
                        "ObservacionLateral" => array('required_if:DatoLateral,2'),
                        "DatoCuello2" => "required",
                        "ObservacionCuello2" => array('required_if:DatoCuello2,2'),
                        "DatoHombro" => "required",
                        "ObservacionHombro" => array('required_if:DatoHombro,2'),
                        "DatoCodo" => "required",
                        "ObservacionCodo" => array('required_if:DatoCodo,2'),
                        "DatoMuneca" => "required",
                        "ObservacionMuneca" => array('required_if:DatoMuneca,2'),
                        "DatoMano" => "required",
                        "ObservacionMano" => array('required_if:DatoMano,2'),
                        "DatoCervical" => "required",
                        "ObservacionCervical" => array('required_if:DatoCervical,2'),
                        "DatoDorsal" => "required",
                        "ObservacionDorsal" => array('required_if:DatoDorsal,2'),
                        "DatoLumbosaca" => "required",
                        "ObservacionLumbosaca" => array('required_if:DatoLumbosaca,2'),
                        "DatoCadera" => "required",
                        "ObservacionCadera" => array('required_if:DatoCadera,2'),
                        "DatoRodilla" => "required",
                        "ObservacionRodilla" => array('required_if:DatoRodilla,2'),
                        "DatoTobillo" => "required",
                        "ObservacionTobillo" => array('required_if:DatoTobillo,2'),

                        "Diagnostico" => "required",
                        "IncapacidadProvisional" => "required",
                        "Aptitud" => "required",
                        "Recomendaciones" => "required" ,
                        ];
       
        return $validaciones;
    }
}

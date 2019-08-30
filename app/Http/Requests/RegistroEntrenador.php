<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroEntrenador extends Request
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
             'ClasificacionEntrenador' => 'required',
             'persona' => 'required',
             'ClasificacionDeportista' => 'required',
             'Agrupacion' => 'required',
             'Deporte' => 'required',
             'Modalidad' => 'required',             
             'LugarExpedicion' => 'required',
             'FechaExpedicion' => 'required|date',
             'Pasaporte' => '',
             'DepartamentoNac' => 'required',
             'LibretaPreg' => 'required',
             'Libreta' => array('required_if:LibretaPreg,1', 'numeric'),
             'Distrito' => array('required_if:LibretaPreg,1', 'numeric'),
             'NombreContacto' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
             'Parentesco' => 'required',
             'FijoContacto' => 'required|numeric|digits_between:7,10',
             'CelularContacto' => 'required|numeric|digits:10',
             'DepartamentoLoc' => 'required',
             'MunicipioLoc' => 'required',
             'Direccion' => 'required|min:3|regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             'Barrio' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
             'Localidad' => 'required',
             'FijoLoc' => 'required|numeric|digits_between:7,10',
             'CelularLoc' => 'required|numeric|digits:10',
             'Correo' => 'required|email|min:7|max:40',
             'Regimen' => 'required',
             'TipoAfiliacion' => 'required',
             'MedicinaPrepago' => 'required',
             'NombreMedicinaPrepago' => array('required_if:MedicinaPrepago,1'),
             'Eps' => array('required_if:MedicinaPrepago,2'),
             'NivelRegimen' => array('required_if:Regimen,2'),
             'RiesgosLaborales' => 'required',
             'Arl' => array('required_if:RiesgosLaborales,1'),
             'FondoPensionPreg' => 'required',
             'FondoPension' => array('required_if:FondoPensionPreg,1'),             
             'Sudadera' => 'required',
             'Camiseta' => 'required',
             'Pantaloneta' => 'required',
             'Tenis' => 'required',
             'GrupoSanguineo' => 'required',
             'Medicamento' => 'required',
             'CualMedicamento' => array('required_if:Medicamento,1'),
             'TiempoMedicamento' => array('required_if:Medicamento,1'),
             'OtroMedicoPreg' => 'required',
             'OtroMedico' => array('required_if:OtroMedicoPreg,1'),
             "Bachiller" => "required",
             "Profesional" => "required",
             "TituloTecnico" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "TituloTecnologo" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "TituloPregrado" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "TituloEspecializacion" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "TituloMaestria" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "TituloDoctorado" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "EscalafonEntrenadores" => 'regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             "Logros" => "required",
            ];
        return $validaciones;
    }
}

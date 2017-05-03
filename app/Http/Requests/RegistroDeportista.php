<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroDeportista extends Request
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
             /*'Resolucion' => array('required_if:Pertenece,1'),
             'Deberes' => array('required_if:Pertenece,1'),
             'persona' => 'required',
             'Pertenece' => 'required',
             'EtapaNacional' => array('required_if:Pertenece,1'),
             'EtapaInternacional' => array('required_if:Pertenece,1'),
             'Smmlv' =>array('required_if:Pertenece,1', 'numeric'),
             'ClasificacionDeportista' => 'required',
             'Agrupacion' => 'required',
             'Deporte' => 'required',
             'Club' => 'required',
             'Modalidad' => 'required',             
             'LugarExpedicion' => 'required',
             'FechaExpedicion' => 'required|date',
             'Pasaporte' => '',
             //'FechaVigenciaPasaporte' => 'date',
             'EstadoCivil' => 'required',
             'Estrato' => 'required',
             'DepartamentoNac' => 'required',
             'LibretaPreg' => 'required',
             'Libreta' => array('required_if:LibretaPreg,1', 'numeric'),
             'Distrito' => array('required_if:LibretaPreg,1', 'numeric'),
             'NombreContacto' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
             'Parentesco' => 'required',
             'FijoContacto' => 'required|numeric|digits_between:7,10',
             'CelularContacto' => 'required|numeric|digits:10',
             'TipoCuenta' => 'required',
             'Banco' => 'required',
             'NumeroCuenta' => 'required|numeric|digits_between:1,20',
             'NumeroHijos' => 'required|numeric|digits_between:1,3',
             'DepartamentoLoc' => 'required',
             'MunicipioLoc' => 'required',
             'Direccion' => 'required|min:3|regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',
             'Barrio' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
             'Localidad' => 'required',
             'FijoLoc' => 'required|numeric|digits_between:7,10',
             'CelularLoc' => 'required|numeric|digits:10',
             'Correo' => 'required|email|min:7|max:40',
             'Regimen' => 'required',
             //'FechaAfiliacion' => 'date',
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
             'OtroMedico' => array('required_if:OtroMedicoPreg,1'),*/
             'Resolucion' => array('required_if:Pertenece,1'),

             'Deberes' => array('required_if:Pertenece,1'),

             'persona' => 'required',

             'Pertenece' => 'required',

             'EtapaNacional' => array('required_if:Pertenece,1'),

             'EtapaInternacional' => array('required_if:Pertenece,1'),

             'Smmlv' =>array('required_if:Pertenece,1', 'numeric'),

             'ClasificacionDeportista' => 'required',

             'Agrupacion' => 'required',

             'Deporte' => 'required',

             'Club' => 'required',

             'Modalidad' => 'required',             

             //--'LugarExpedicion' => 'required',

             //--'FechaExpedicion' => 'required|date',

             'Pasaporte' => '',

             //'FechaVigenciaPasaporte' => 'date',

             //--'EstadoCivil' => 'required',

             //--'Estrato' => 'required',

             'DepartamentoNac' => 'required',

             //--'LibretaPreg' => 'required',

             'Libreta' => array('required_if:LibretaPreg,1', 'numeric'),

             'Distrito' => array('required_if:LibretaPreg,1', 'numeric'),

             //--'NombreContacto' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',

             //--'Parentesco' => 'required',

             //--'FijoContacto' => 'required|numeric|digits_between:7,10',

             //--'CelularContacto' => 'required|numeric|digits:10',

             //--'TipoCuenta' => 'required',

             //--'Banco' => 'required',

             //--'NumeroCuenta' => 'required|numeric|digits_between:1,20',

             'NumeroHijos' => 'required|numeric|digits_between:1,3',

             //--'DepartamentoLoc' => 'required',

             //--'MunicipioLoc' => 'required',

             //--'Direccion' => 'required|min:3|regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u',

             //--'Barrio' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',

             //--'Localidad' => 'required',

             //--'FijoLoc' => 'required|numeric|digits_between:7,10',

             //--'CelularLoc' => 'required|numeric|digits:10',

             'Correo' => 'required|email|min:7|max:40',

             //--'Regimen' => 'required',

             //'FechaAfiliacion' => 'date',

             //--'TipoAfiliacion' => 'required',

             //--'MedicinaPrepago' => 'required',

             'NombreMedicinaPrepago' => array('required_if:MedicinaPrepago,1'),

             'Eps' => array('required_if:MedicinaPrepago,2'),

             'NivelRegimen' => array('required_if:Regimen,2'),

             //--'RiesgosLaborales' => 'required',

             'Arl' => array('required_if:RiesgosLaborales,1'),

             //--'FondoPensionPreg' => 'required',

             'FondoPension' => array('required_if:FondoPensionPreg,1'),             

             //--'Sudadera' => 'required',

             //--'Camiseta' => 'required',

             //--'Pantaloneta' => 'required',

             //--'Tenis' => 'required',

             'GrupoSanguineo' => 'required',

             //--'Medicamento' => 'required',

             'CualMedicamento' => array('required_if:Medicamento,1'),

             'TiempoMedicamento' => array('required_if:Medicamento,1'),

             //--'OtroMedicoPreg' => 'required',

             'OtroMedico' => array('required_if:OtroMedicoPreg,1'),
            ];

            if($this->ClasificacionDeportista == 2){
                $validaciones['Discapacidad'] = 'required';
                $validaciones['Diagnostico'] = 'required';
                $validaciones['DiagnosticoEdad'] = array('required_if:Diagnostico,1');
                $validaciones['ClasificacionFuncional'] = 'required';
                $validaciones['Silla'] = 'required';
                $validaciones['Cuidador'] = array('required_if:Silla,1');
                $validaciones['Auxiliar'] = array('required_if:Silla,1');
                $validaciones['ClasificadoNivelInternacional'] = 'required';
                $validaciones['FechaCI'] = array('required_if:ClasificadoNivelInternacional,1|date');
                $validaciones['EventoCI'] = array('required_if:ClasificadoNivelInternacional,1');
                $validaciones['EdadDeportiva'] = 'required|numeric';
                $validaciones['resultadoNacional'] = 'required';
                $validaciones['resultadoInternacional'] = 'required';
            }
       
        return $validaciones;
    }
}

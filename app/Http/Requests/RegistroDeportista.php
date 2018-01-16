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
                    'Pertenece' => 'required',
                    'ClasificacionDeportista' => 'required',
                   // 'Agrupacion' => array('required_if:ClasificacionDeportista,1'),
                    'Deporte' => array('required_if:ClasificacionDeportista,1'),
                ];

        if($this->Pertenece == 1){
            
            $validaciones['Resolucion'] = array('required_if:Pertenece,1');

            $validaciones['Deberes'] = array('required_if:Pertenece,1');

            $validaciones['persona'] = 'required';

             

            $validaciones['EtapaNacional'] = array('required_if:Pertenece,1');

            $validaciones['EtapaInternacional'] = array('required_if:Pertenece,1');

            $validaciones['Smmlv'] =array('required_if:Pertenece,1', 'numeric');

             

            $validaciones['Club'] = 'required';

            $validaciones['Modalidad'] = array('required_if:ClasificacionDeportista,1');

           // $validaciones['AgrupacionP'] = array('required_if:ClasificacionDeportista,2');

            $validaciones['DeporteP'] = array('required_if:ClasificacionDeportista,2');

            $validaciones['ModalidadP'] = array('required_if:ClasificacionDeportista,2');

            $validaciones['LugarExpedicion'] = 'required';

            $validaciones['FechaExpedicion'] = 'required|date';

            $validaciones['Pasaporte'] = '';

            $validaciones['FechaVigenciaPasaporte'] = 'date';

            $validaciones['EstadoCivil'] = 'required';

            $validaciones['Estrato'] = 'required';

            $validaciones['DepartamentoNac'] = 'required';

            $validaciones['LibretaPreg'] = 'required';

            $validaciones['Libreta'] = array('required_if:LibretaPreg,1', 'numeric');

            $validaciones['Distrito'] = array('required_if:LibretaPreg,1', 'numeric');

            $validaciones['NombreContacto'] = 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u';

            $validaciones['Parentesco'] = 'required';

            $validaciones['FijoContacto'] = 'required|numeric|digits_between:7,10';

            $validaciones['CelularContacto'] = 'required|numeric|digits:10';

            $validaciones['TipoCuenta'] = 'required';

            $validaciones['Banco'] = 'required';

            $validaciones['NumeroCuenta'] = 'required|numeric|digits_between:1,20';

            $validaciones['NumeroHijos'] = 'required|numeric|digits_between:1,3';

            $validaciones['DepartamentoLoc'] = 'required';

            $validaciones['MunicipioLoc'] = 'required';

            $validaciones['Direccion'] = 'required|min:3|regex:/^[(a-zA-Z0-9\s\#\-\°)]+$/u';

            $validaciones['Barrio'] = 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u';

            $validaciones['Localidad'] = 'required';

            $validaciones['FijoLoc'] = 'required|numeric|digits_between:7,10';

            $validaciones['CelularLoc'] = 'required|numeric|digits:10';

            $validaciones['Correo'] = 'required|email|min:7|max:40';

            $validaciones['Regimen'] = 'required';

            $validaciones['FechaAfiliacion'] = 'date';

            $validaciones['TipoAfiliacion'] = 'required';

            $validaciones['MedicinaPrepago'] = 'required';

            $validaciones['NombreMedicinaPrepago'] = array('required_if:MedicinaPrepago,1');

            $validaciones['Eps'] = array('required_if:MedicinaPrepago,2');

            $validaciones['NivelRegimen'] = array('required_if:Regimen,2');

            $validaciones['RiesgosLaborales'] = 'required';

            $validaciones['Arl'] = array('required_if:RiesgosLaborales,1');

            $validaciones['FondoPensionPreg'] = 'required';

            $validaciones['FondoPension'] = array('required_if:FondoPensionPreg,1');

            $validaciones['Sudadera'] = 'required';

            $validaciones['Camiseta'] = 'required';

            $validaciones['Pantaloneta'] = 'required';

            $validaciones['Tenis'] = 'required';

            $validaciones['GrupoSanguineo'] = 'required';

            $validaciones['Medicamento'] = 'required';

            $validaciones['CualMedicamento'] = array('required_if:Medicamento,1');

            $validaciones['TiempoMedicamento'] = array('required_if:Medicamento,1');

            $validaciones['OtroMedicoPreg'] = 'required';

            $validaciones['OtroMedico'] = array('required_if:OtroMedicoPreg,1');
           
             /*
             'Resolucion' => array('required_if:Pertenece,1'),

             'Deberes' => array('required_if:Pertenece,1'),

             'persona' => 'required',

             'Pertenece' => 'required',

             'EtapaNacional' => array('required_if:Pertenece,1'),

             'EtapaInternacional' => array('required_if:Pertenece,1'),

             'Smmlv' =>array('required_if:Pertenece,1', 'numeric'),

             'ClasificacionDeportista' => 'required',

             //'Agrupacion' => array('required_if:ClasificacionDeportista,1'),

             'Deporte' => array('required_if:ClasificacionDeportista,1'),

             'Club' => 'required',

             'Modalidad' => array('required_if:ClasificacionDeportista,1'),

            // 'AgrupacionP' => array('required_if:ClasificacionDeportista,2'),

             'DeporteP' => array('required_if:ClasificacionDeportista,2'),

             'ModalidadP' => array('required_if:ClasificacionDeportista,2'),

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

             'OtroMedico' => array('required_if:OtroMedicoPreg,1'),*/
            
             }       
           /* elseif ($this->Pertenece == 2) {
                
            }*/

            if($this->ClasificacionDeportista == 2 /*&& $this->Pertenece == 1*/){
                $validaciones['Discapacidad'] = 'required';
                $validaciones['DeporteP'] = 'required';
                $validaciones['ModalidadP'] = 'required';
                $validaciones['DiagnosticoEdad'] = array('required_if:Diagnostico,1');
                
                if($this->Pertenece == 1){
                    $validaciones['Diagnostico'] = 'required';
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
            }
       
        return $validaciones;
    }
}

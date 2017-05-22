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
            /* 'Resolucion' => array('required_if:Pertenece,1'),
             'Deberes' => array('required_if:Pertenece,1'),
             'persona' => 'required',
             'Pertenece' => 'required',


             'Ocupacion' => 'required',
             'NivelEstudio' => 'required',
             'Dominancia' => 'required',
             'NombreMadre' => 'required',
             'NombrePadre' => 'required',

             


             'Agrupacion' => array('required_if:ClasificacionDeportista,1'),
             'Deporte' => array('required_if:ClasificacionDeportista,1'),
             'Club' => 'required',
             'Modalidad' => array('required_if:ClasificacionDeportista,1'),
             'AgrupacionP' => array('required_if:ClasificacionDeportista,2'),
             'DeporteP' => array('required_if:ClasificacionDeportista,2'),
             'ModalidadP' => array('required_if:ClasificacionDeportista,2'),
             'Pasaporte' => '',
             'DepartamentoNac' => 'required',
             'Libreta' => array('required_if:LibretaPreg,1', 'numeric'),
             'Distrito' => array('required_if:LibretaPreg,1', 'numeric'),
             'NumeroHijos' => 'required|numeric|digits_between:1,3',
             'Correo' => 'required|email|min:7|max:40',
             'NombreMedicinaPrepago' => array('required_if:MedicinaPrepago,1'),
             'Eps' => array('required_if:MedicinaPrepago,2'),
             'NivelRegimen' => array('required_if:Regimen,2'),
             'Arl' => array('required_if:RiesgosLaborales,1'),
             'CualMedicamento' => array('required_if:Medicamento,1'),
             'TiempoMedicamento' => array('required_if:Medicamento,1'),
             'OtroMedico' => array('required_if:OtroMedicoPreg,1'),*/
            ];

            if($this->ClasificacionDeportista == 2){
               /* $validaciones['Discapacidad'] = 'required';
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
                $validaciones['resultadoInternacional'] = 'required';*/
            }
       
        return $validaciones;
    }
}

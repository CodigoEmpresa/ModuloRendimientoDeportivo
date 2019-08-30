<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroVisita extends Request
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
            'Genograma_Observacion'=> 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'FechaIntervencion' => 'required|date',
            'NombresAtiende' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'ApellidosAtiende' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'DocumentoAtiende' => 'required|numeric',
            'op1' => 'required',
            'op2' => 'required',
            'op2o1' => array('required_if:op2,Propia'),
            'pn3' => 'required',
            'p3' => 'required',
            'op4' => 'required',
            'op5' => 'required',
            'op6' => 'required',
            'Habitacion' => 'required|numeric',
            'Bano' => 'required|numeric',
            'Cocina' => 'required|numeric',
            'Sala' => 'required|numeric',
            'Comedor' => 'required|numeric',
            'ZRopas' => 'required|numeric',
            'OtrosDistribucion' => 'min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Camas' => 'required|numeric',
            'Closets' => 'required|numeric',
            'Televisor' => 'required|numeric',
            'Nevera' => 'required|numeric',
            'Estufa' => 'required|numeric',
            'OtrosMuebles' => 'min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'op7' => 'required',
            'op8' => 'required',
            'op9' => 'required',
            'op10' => 'required',
            'op11' => 'required',
            'op12' => 'required',
            'op13' => '',
            'otro13o4' => array('required_if:op13,Otro'),
            'TotalIngreso' => 'numeric',
            'Alimentacion' => 'numeric',
            'Arriendo' => 'numeric',
            'Educacion' => 'numeric',
            'CuotaV' => 'numeric',
            'Salud' => 'numeric',
            'Recreacion' => 'numeric',
            'Servicios' => 'numeric',
            'Transporte' => 'numeric',
            'Adeudan' => 'min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'MontoEgresos' => 'numeric',
            'MontoDeudas' => 'numeric',
            'op15' => '',
            'PracticasDeportivas' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'JuegosFamiliares' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'SalidasPublicos' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Quehaceres' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'ActividadesLibre' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Television' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'ActividadesAcademicas' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Internet' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg16' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg17' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg18' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg19' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg20' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg21' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'Preg22' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
            'vector_miembros' => 'required|min:4',
        ];      
        $contador6 = count($this->op6)-1;
        if ($this->op6[$contador6] == 'Gas'){ $validaciones['op6o5'] = 'required'; }
        if ($this->op6[$contador6] == 'Otros'){ $validaciones['otro6o6'] = 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u'; }

        return $validaciones;
    }
}
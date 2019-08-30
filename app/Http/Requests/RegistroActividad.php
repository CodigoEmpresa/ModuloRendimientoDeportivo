<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroActividad extends Request
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
          "ActividadId" => "",
          "Descripcion" => "required|min:5",
          "Actividad" => "required",
          "Otro_Actividad" => "required_if:Actividad,4",
          "DeportistaP" => "required|numeric",
          "DeportistaA" => "required_with:ActividadId|numeric",
          "MultiP" => "required|numeric",
          "MultiA" => "required_with:ActividadId|numeric",
          "EntrenadorP" => "required|numeric",
          "EntrenadorA" => "required_with:ActividadId|numeric",
          "ComisionadoP" => "required|numeric",
          "ComisionadoA" => "required_with:ActividadId|numeric",
          "Otros" => "",
          "OtrosP" => "required_with:Otros",
          "OtrosA" => "required_with:Otros",
          "Fecha_Programada" => "required|date",
          "Fecha_Realizada" => "required_with:ActividadId|date",
          "Reprogramacion" => "",
          "Total_Asistentes" => "required_with:ActividadId|numeric",
          "Observaciones" => "required_with:ActividadId",
          "Total_Evaluadores" => "required_with:ActividadId|numeric",
          "Nombre_Gestor" => "required|min:3",
          "Nombre_Coordinador" => "required|min:3",            
        ];              
        return $validaciones;
    }
}
<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroValoracionPsico extends Request
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
        'deportista' => 'required',
        'Discapacidad' => 'required|min:3|regex:/^[(a-zA-Z\s)]+$/u',
       // 'Fecha_AnioP' => 'required',
        'EdadPreg' => 'required|numeric|digits_between:1,4',
        'PracticaPreg' => 'required|numeric|digits_between:1,4',        
        'op1' => 'required',
        'op2' => 'required',
        'op3' => 'required',
        'op5' => 'required',
        'op6' => 'required',
        'op8' => 'required',
        'op81' => 'required',
        'op82' => 'required',
        'op9' => 'required',
        'op10' => 'required',
        'op11' => array('required_if:op10,Si'),
        'op111' => array('required_if:op10,Si'),
        'op112' => array('required_if:op10,Si'),
        'op113' => array('required_if:op10,Si'),
        'op114' => array('required_if:op10,Si'),
        'op12' => array('required_if:op10,Si'),
        'otro12' => array('required_if:op10,Si'),
        'op13' => array('required_if:op10,Si'),
        'op14' => array('required_if:op10,Si'),
        'otro14' => array('required_if:op14,Si'),
        'op15' => array('required_if:op10,No'),
        'op16' => array('required_if:op10,No'),
        'op17' => array('required_if:op10,No'),
        'op19' => 'required',
        'op191' => array('required_if:op19,Si'),
        'op192' => array('required_if:op19,Si'),
        'op193' => array('required_if:op19,Si'),
        'op194' => array('required_if:op19,Si'),
        'op195' => array('required_if:op19,Si'),
        'op196' => array('required_if:op19,Si'),
        'op20' => 'required',
        'op21' => 'required',
        'op22' => 'required',
        'op23' => 'required',
        'op24' => 'required',
        'op25' => array('required_if:op19,No'),
        /*'op26' => 'required',
        'otro26' => array('required_if:op26,Otros'),*/
        'op27' => 'required',        
        'op281' => 'required',
        'op282' => 'required',
        'op283' => 'required',
        'op284' => 'required',
        'op285' => 'required',
        'op286' => 'required',
        'op287' => 'required',
        'op288' => 'required',
        'otro281' => 'required',
        'otro282' => 'required',
        'otro283' => 'required',
        'otro284' => 'required',
        'otro285' => 'required',
        'otro286' => 'required',
        'otro287' => 'required',
        'otro288' => 'required',
        'op29' => 'required',
        'op30' => 'required',
        'otro30' => 'required',
        'op311a' => 'required|numeric',
        'op311b' => 'required',
        'op312a' => 'required|numeric',
        'op312b' => 'required',
        'op313a' => 'required|numeric',
        'op313b' => 'required',
        'op314a' => 'required|numeric',
        'op314b' => 'required',
        'op315a' => 'required|numeric',
        'op315b' => 'required',
        'op316a' => 'required|numeric',
        'op316b' => 'required',
        'op317a' => 'required|numeric',
        'op317b' => 'required',

        'op32' => 'required',
        'otro32' => array('required_if:op32,Si'),
        'op33' => 'required',
        'otro33' => array('required_if:op33,Si'),
        //'op34' => 'required',
        'op35' => 'required',
        'op36' => 'required',
        'otro36' => 'required',
        'op37' => 'required',
        'otro37' => 'required',
        'op38' => 'required',
        'otro38' => 'required',
        'op39' => 'required',
        'otro39' => 'required',
        'op40' => 'required',
        'op42' => 'required',
        'op43' => 'required',
        'op44' => 'required',
        'op45' => 'required',
        'otro45' => 'required',
        'op46' => 'required',
        'op47' => 'required',
        'op48' => 'required',
        'otro48' => 'required',
        'op49' => 'required',
        'op50' => 'required',
        'otro50' => 'required',
        'op51' => 'required',
        'op52' => 'required',
        'ConceptoProfesional' => 'required',
        //'LibretaPorque' => array('required_if:LibretaPreg,2|required_if:Genero,1'),
        'DesplazamientoPreg' => 'required',
        'DesplazamientoDesc' => array('required_if:DesplazamientoPreg,1'),
        'op4' => 'array|required',
        'op26' => 'array|required',
        'op7' => 'array|required',
        'op41' => 'array|required',
        'op53' => 'array|required',
        'op54' => 'array|required',
        //'vector_idiomas' => 'required|min:4',
        'vector_quien' => 'required|min:4',
        //'vector_riesgo'=> 'required|min:4',
            ];
        $contador4 = count($this->op4)-1;
        if ($this->op4[$contador4] == 'Otros'){ $validaciones['otro4'] = 'required'; }

        $contador26 = count($this->op26)-1;
        if ($this->op26[$contador26] == 'Otros'){ $validaciones['otro26'] = 'required'; }

        $contador34 = count($this->op34)-1;
        if ($this->op34[$contador34] == 'Otros'){ $validaciones['otro34'] = 'required'; }

        $contador41 = count($this->op41)-1;
        if ($this->op41[$contador41] == 'Otros'){ $validaciones['otro41'] = 'required'; }

        if ($this->op47 == 'Si'){ $validaciones['op472'] = 'array|required'; }
        $contador472 = count($this->op472)-1;
        if ($this->op472[$contador472] == 'Otras'){ $validaciones['otro472'] = 'required'; }

        if ($this->op52 == 'Si'){ $validaciones['op522'] = 'array|required'; }
        $contador522 = count($this->op522)-1;
        if ($this->op522[$contador522] == 'Otras'){ $validaciones['otro522'] = 'required'; }
        
        //$validaciones = [];
       
        return $validaciones;
    }
}

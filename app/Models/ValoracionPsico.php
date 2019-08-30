<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValoracionPsico extends Model
{
    protected $table = 'valoracion_psicosocial';
    protected $primaryKey = 'Id';    
    protected $fillable = ['Nombre_Estrato', 'Id', 'Deportista_Id', 'Discapacidad', 'EdadInicio', 'AniosPractica', 'DesplazamientoPreg', 'Desplazamiento', 'P1', 
    						'P2', 'P3', 'P5', 'P6', 'P8', 'P81', 'P82', 'P9', 'P10', 'P11', 'P111', 'P112', 'P113', 'P114', 'P13', 'P15', 'P16', 'P17', 'P19',
            				'P191', 'P192', 'P193', 'P194', 'P195', 'P196', 'P20', 'P21', 'P22', 'P23', 'P24', 'P25', 'P27', 'P29', 'P34', 'P35', 'P40', 
            				'P42', 'P43', 'P44', 'P46', 'P49', 'P51', 'ConceptoProfesional'];

	public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function idioma(){
        return $this->hasMany('App\Models\PreguntaIdioma', 'ValoracionI_Id');
    }

    public function quien(){
        return $this->hasMany('App\Models\PreguntaQuien', 'ValoracionQ_Id');
    }

    public function preguntaA(){
        return $this->hasMany('App\Models\PreguntaA', 'ValoracionA_Id');
    }

    public function valoracionRiesgo(){
        return $this->hasMany('App\Models\ValoracionRiesgo', 'Valoracion_Id');
    }
}

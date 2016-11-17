<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEvaluacion extends Model
{
    protected $table = 'tipo_evaluacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_Evaluacion'];

    public function division(){   
    	return $this->hasMany('App\Models\Division', 'Tipo_Evaluacion_Id');  
    }
}

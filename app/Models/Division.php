<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
	protected $table = 'division';
    protected $primaryKey = 'Id';
    protected $fillable = ['Clasificacion_Deportista_Id', 'Agrupacion_Id', 'Deporte_Id', 'Modalidad_Id', 'Rama_Id', 'Categoria_Id', 'Tipo_Evaluacion_Id','Nombre_Division'];

    public function ClasificacionDeportista(){  return $this->belongsTo('App\Models\ClasificacionDeportista', 'Clasificacion_Deportista_Id'); }
    public function Agrupacion(){  return $this->belongsTo('App\Models\Agrupacion', 'Agrupacion_Id'); }
    public function Deporte(){  return $this->belongsTo('App\Models\Deporte', 'Deporte_Id'); }
    public function Modalidad(){  return $this->belongsTo('App\Models\Modalidad', 'Modalidad_Id'); }
    public function Rama(){  return $this->belongsTo('App\Models\Rama', 'Rama_Id'); }
    public function Categoria(){  return $this->belongsTo('App\Models\Categoria', 'Categoria_Id'); }
    public function tipoEvaluacion(){  return $this->belongsTo('App\Models\TipoEvaluacion', 'Tipo_Evaluacion_Id'); }

    public function certamen_division()
    {
        return $this->belongsToMany('App\Models\Certamen','certamen_division','Division_Id','Certamen_Id');
    }
}
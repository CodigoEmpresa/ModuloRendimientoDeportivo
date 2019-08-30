<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaParalimpico extends Model
{
    protected $table = 'deportista_paralimpico';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id',  'Discapacidad_Id', 'Diagnostico_Id', 'Clasificacion_Funcional_Id', 'Silla_Id', 'Uso_Silla_Id', 'Auxiliar_Id', 'Clasificacion_Funcional_Internacional_Id',
    					   'EdadAdquirido', 'Fecha_Clasificacion', 'Evento_Clasificacion', 'Resultado_Nacional', 'Resultado_Internacional'];

   	public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function Discapacidad(){
        return $this->belongsTo('App\Models\Discapacidad', 'Discapacidad_Id');
    }

    public function Diagnostico(){
        return $this->belongsTo('App\Models\Diagnostico', 'Diagnostico_Id');
    }

    public function ClasificacionFuncional(){
        return $this->belongsTo('App\Models\ClasificacionFuncional', 'Clasificacion_Funcional_Id');
    }
}
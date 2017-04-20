<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsistenciaEntrenamiento extends Model
{
    protected $table = 'asistencia_entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Entrenamiento_Id', 'Fecha', 'Numero_Dia', 'Convencion_Asistencia_Id', /*'Verificacion_Convencion_1_Id', 'Verificacion_Convencion_2_Id', 'Verificacion_Convencion_3_Id',*/ 'Url_Soporte_Medico', 'Url_Soporte_Calamidad'];

    public function deportistaEntrenamiento(){
        return $this->belongsTo('App\Models\DeportistaEntrenamiento', 'Deportista_Entrenamiento_Id');
    }

    public function entrenamiento(){
        return $this->belongsTo('App\Models\Entrenamiento', 'Entrenamiento_Id');
    }

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function convencionAsistencia(){
        return $this->belongsTo('App\Models\ConvencionAsistencia', 'Convencion_Asistencia_Id');
    }

    /*public function verificacionConvencion1(){
        return $this->belongsTo('App\Models\ConvencionAsistencia', 'Verificacion_Convencion_1_Id');
    }

    public function verificacionConvencion2(){
        return $this->belongsTo('App\Models\ConvencionAsistencia', 'Verificacion_Convencion_2_Id');
    }

    public function verificacionConvencion3(){
        return $this->belongsTo('App\Models\ConvencionAsistencia', 'Verificacion_Convencion_3_Id');
    }*/
}
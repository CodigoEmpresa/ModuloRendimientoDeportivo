<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadClasificacionFuncional extends Model
{
    protected $table = 'modalidad_clasificacion_funcional';
    protected $primaryKey = 'Id';
    protected $fillable = ['Modalidad_Id', 'Clasificacion_Funcional_Id'];

    public function modalidad(){
        return $this->belongsTo('App\Models\Modalidad', 'Modalidad_Id');
    }

    public function clasificacion_funcional(){
        return $this->belongsTo('App\Models\Clasificacion_Funcional', 'Clasificacion_Funcional_Id');
    }
}

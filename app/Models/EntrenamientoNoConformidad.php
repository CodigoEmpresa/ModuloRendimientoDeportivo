<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrenamientoNoConformidad extends Model
{
    protected $table = 'entrenamiento_no_conformidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Entrenamiento_Id', 'Tratamiento_Conformidad_Id', 'Fecha', 'Numero_Requisito', 'Descripcion_No_Conformidad', 'Descripcion_Accion', 'Inconvenientes'];

    public function entrenamiento() {
        return $this->belongsTo('App\Models\Entrenamiento', 'Entrenamiento_Id');
    }

    public function tratamientoConformidad() {
        return $this->belongsTo('App\Models\TratamientoConformidad', 'Tratamiento_Conformidad_Id');
    }
}

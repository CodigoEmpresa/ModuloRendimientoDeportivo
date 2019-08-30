<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificacionEntrenamiento extends Model
{
    protected $table = 'verificacion_entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Entrenamiento_Id', 'Fecha', 'Numero_Dia', 'P_1', 'P_2', 'P_3'];

    public function entrenamiento() {
        return $this->belongsTo('App\Models\Entrenamiento', 'Entrenamiento_Id');
    }
}
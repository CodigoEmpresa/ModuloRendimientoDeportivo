<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialResultado extends Model
{
    protected $table = 'historia_inicial_resultado';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Diagnostico', 'Incapacacidad_Provisional', 'Aptitud_Id', 'Recomendacion_Tratamiento'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialOsteomuscular extends Model
{
    protected $table = 'historia_inicial_antecedente_osteomuscular';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Descripcion'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialPatologico extends Model
{
    protected $table = 'historia_inicial_antecedente_patologico';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Descripcion'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}

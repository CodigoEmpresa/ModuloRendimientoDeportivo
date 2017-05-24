<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialGinecologico extends Model
{
    protected $table = 'historia_inicial_antecedente_gineco';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Menarquia', 'Ciclo', 'Regular', 'Dismenorrea', 'Fum', 'Fup', 'G', 'P', 'V', 'A', 'Amenorrea', 'Planifica_Preg', 'Metodo_Planificacion'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}
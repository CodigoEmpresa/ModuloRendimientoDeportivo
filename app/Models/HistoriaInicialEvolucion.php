<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialEvolucion extends Model
{
     protected $table = 'historia_inicial_evolucion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Observacion'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}

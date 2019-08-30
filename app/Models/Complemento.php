<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    protected $table = 'complemento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Tipo_Complemento_Id', 'Nombre_Complemento', 'Valor_Complemento'];
    
    public function TipoComplemento(){
        return $this->belongsTo('App\Models\TipoComplemento', 'Tipo_Complemento_Id');
    }

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}
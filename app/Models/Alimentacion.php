<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alimentacion extends Model
{
    protected $table = 'alimentacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Tipo_Alimentacion_Id', 'Nombre_Alimentacion', 'Valor_Alimentacion'];
    
    public function TipoAlimentacion(){
        return $this->belongsTo('App\Models\TipoAlimentacion', 'Tipo_Alimentacion_Id');
    }
}

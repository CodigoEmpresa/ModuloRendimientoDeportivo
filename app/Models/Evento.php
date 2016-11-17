<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Clasificacion_Deportista_Id', 'Tipo_Nivel_Id', 'Nombre_Evento'];

    public function clasificacionDeportiva(){
        return $this->belongsTo('App\Models\ClasificacionDeportista', 'Clasificacion_Deportista_Id');
    }

    public function tipoNivel(){
        return $this->belongsTo('App\Models\TipoNivel', 'Tipo_Nivel_Id');
    }

    public function certamen(){
        return $this->hasMany('App\Models\certamen', 'Evento_Id');
    }
}

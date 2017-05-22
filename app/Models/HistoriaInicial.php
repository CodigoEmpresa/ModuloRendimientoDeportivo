<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicial extends Model
{
    protected $table = 'historia_inicial';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id', 'Ocupacion_Id', 'NivelEstudio_Id', 'Dominancia_Id', 'Nombre_Padre', 'Nombre_Madre', 'Entrenamiento_Continuo_Preg','Nombre_Acudiente', 'Telefono_Acudiente', 'Nombre_Responsable', 'Telefono_Responsable'];


    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function ocupacion(){
        return $this->belongsTo('App\Models\Ocupacion', 'Ocupacion_Id');
    }

    public function nivelEstudio(){
        return $this->belongsTo('App\Models\NivelEstudio', 'NivelEstudio_Id');
    }

    public function dominancia(){
        return $this->belongsTo('App\Models\Dominancia', 'Dominancia_Id');
    }
}

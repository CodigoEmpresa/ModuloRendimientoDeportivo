<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicial extends Model
{
    protected $table = 'historia_inicial';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id', 'Ocupacion_Id', 'NivelEstudio_Id', 'Dominancia_Id', 'Medico_Id',  'Edad_Deportiva', 'Nombre_Padre', 'Nombre_Madre', 'Entrenamiento_Continuo_Preg', 'Plan_Entrenamiento_Preg', 'Nombre_Acudiente', 'Telefono_Acudiente', 'Nombre_Responsable', 'Telefono_Responsable'];


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

    public function historiaInicialConsulta(){
        return $this->hasMany('App\Models\HistoriaInicialConsulta', 'Historia_Inicial_Id');
    }

    public function historiaInicialExamenFisico(){
        return $this->hasMany('App\Models\HistoriaInicialExamenFisico', 'Historia_Inicial_Id');
    }

    public function historiaInicialGinecologico(){
        return $this->hasMany('App\Models\HistoriaInicialGinecologico', 'Historia_Inicial_Id');
    }

    public function historiaInicialOsteomuscular(){
        return $this->hasMany('App\Models\HistoriaInicialOsteomuscular', 'Historia_Inicial_Id');
    }

    public function historiaInicialPatologico(){
        return $this->hasMany('App\Models\HistoriaInicialPatologico', 'Historia_Inicial_Id');
    }

    public function historiaInicialResultado(){
        return $this->hasMany('App\Models\HistoriaInicialResultado', 'Historia_Inicial_Id');
    }

    public function historiaInicialEvolucion(){
        return $this->hasMany('App\Models\HistoriaInicialEvolucion', 'Historia_Inicial_Id');
    }
}
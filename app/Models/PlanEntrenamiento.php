<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEntrenamiento extends Model
{
    protected $table = 'plan_entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id', 'Entrenador_Id', 'Url_Word', 'Url_Excel', 'Observacion_Metodologo', 'Observacion_Entrenador', 'Numero_Plan'];

    public function entrenador(){
        return $this->belongsTo('App\Models\Entrenador', 'Entrenador_Id');
    }

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function versionPlanEntrenamiento(){
        return $this->hasMany('App\Models\VersionPlanEntrenamiento', 'Plan_Entrenamiento_Id');
    }
}
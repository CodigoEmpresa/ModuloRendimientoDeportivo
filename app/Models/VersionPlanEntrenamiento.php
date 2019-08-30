<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersionPlanEntrenamiento extends Model
{
   protected $table = 'version_plan_entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Plan_Entrenamiento_Id', 'Url_Word', 'Url_Excel', 'Observacion_Metodologo', 'Observacion_Entrenador', 'Numero_Version'];

    public function plan_entrenamiento(){
        return $this->belongsTo('App\Models\PlanEntrenamiento', 'Plan_Entrenamiento_Id');
    }
}
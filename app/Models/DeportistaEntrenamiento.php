<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaEntrenamiento extends Model
{
    protected $table = 'deportista_entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id', 'Entrenamiento_Id'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function entrenamiento(){
        return $this->belongsTo('App\Models\Entrenamiento', 'Entrenamiento_Id');
    }

    public function deportistaAsistencia(){
        return $this->hasMany('App\Models\AsistenciaEntrenamiento', 'Deportista_Entrenamiento_Id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    protected $table = 'tratamiento_conformidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Entrenador_Id', 'Horario_Id', 'Lugar_Entrenamiento', 'Fecha_Inicio', 'Fecha_Fin'];

    public function entrenador(){
        return $this->belongsTo('App\Models\Entrenador', 'Entrenador_Id');
    }

    public function horario(){
        return $this->belongsTo('App\Models\Horario', 'Horario_Id');
    }    

    public function deportistaEntrenamiento() {
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Entrenamiento_Id');
    }

    public function entrenamientoNoConformidad() {
        return $this->hasMany('App\Models\EntrenamientoNoConformidad', 'Entrenamiento_Id');
    }
}

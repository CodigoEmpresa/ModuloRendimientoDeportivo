<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    protected $table = 'entrenamiento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Entrenador_Id', 'Lugar_Entrenamiento', 'Fecha_Inicio', 'Fecha_Fin', 'Hora_Inicio', 'Hora_Fin'];

    public function entrenador(){
        return $this->belongsTo('App\Models\Entrenador', 'Entrenador_Id');
    }  

    /*public function deportistaEntrenamiento() {
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Entrenamiento_Id');
    }*/

     public function deportistaEntrenamiento() {
        return $this->belongsToMany('App\Models\Deportista', 'deportista_entrenamiento', 'Entrenamiento_Id', 'Deportista_Id');
    }

    public function entrenamientoNoConformidad() {
        return $this->hasMany('App\Models\EntrenamientoNoConformidad', 'Entrenamiento_Id');
    }

    public function entrenamientoVerificacion() {
        return $this->hasMany('App\Models\VerificacionEntrenamiento', 'Entrenamiento_Id');
    }
}

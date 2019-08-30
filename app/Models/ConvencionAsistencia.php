<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvencionAsistencia extends Model
{
    protected $table = 'convencion_asistencia';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Convencion_asistencia'];

    public function convencionAsistencia(){
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Convencion_Asistencia_Id');
    }

    public function verificacionConvencion1(){
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Verificacion_Convencion_1_Id');
    }

    public function verificacionConvencion2(){
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Verificacion_Convencion_2_Id');
    }

    public function verificacionConvencion3(){
        return $this->hasMany('App\Models\DeportistaEntrenamiento', 'Verificacion_Convencion_3_Id');
    }
}

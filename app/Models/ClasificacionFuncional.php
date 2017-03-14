<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionFuncional extends Model
{
    protected $table = 'clasificacion_funcional';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Clasificacion_Funcional'];

    public function deportistaParalimpico(){
        return $this->hasMany('App\Models\DeportistaParalimpico', 'Clasificacion_Funcional_Id');
    }

    public function modalidad_clasificacion_funcional() {
        return $this->hasMany('App\Models\Modalidad_Clasificacion_Funcional', 'Clasificacion_Funcional_Id');  
    }
} 

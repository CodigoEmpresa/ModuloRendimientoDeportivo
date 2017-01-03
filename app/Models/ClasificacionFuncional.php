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
} 

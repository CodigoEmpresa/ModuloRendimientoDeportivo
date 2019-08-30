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

    public function clasificacionFuncionalModalidad() {
        return $this->belongsToMany('App\Models\Modalidad', 'modalidad_clasificacion_funcional', 'Modalidad_Id', 'Clasificacion_Funcional_Id')
                ->withTimestamps()/*->withPivot('Cantidad')->withPivot('Fecha')->withPivot('Valor')*/;
    }
} 

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionDeportista extends Model
{
    protected $table = 'clasificacion_deportista';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Clasificacion_Deportista'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Clasificacion_Deportista_Id');
    }

    public function agrupacion(){
        return $this->hasMany('App\Models\Agrupacion', 'ClasificacionDeportista_Id');
    }

    public function tipoEtapa(){
        return $this->hasMany('App\Models\TipoEtapa', 'Clasificacion_Deportista_Id');
    }

    public function division(){   
        return $this->hasMany('App\Models\Division', 'Clasificacion_Deportista_Id');  
    }

    public function evento(){   
        return $this->hasMany('App\Models\Evento', 'Clasificacion_Deportista_Id');  
    }
}
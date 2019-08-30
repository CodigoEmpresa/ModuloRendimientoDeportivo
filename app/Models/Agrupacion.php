<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agrupacion extends Model
{
    protected $table = 'agrupacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['ClasificacionDeportista_Id', 'Nombre_Agrupacion'];

    public function ClasificacionDeportista(){
        return $this->belongsTo('App\Models\ClasificacionDeportista', 'ClasificacionDeportista_Id');
    }

    public function deporte(){
        return $this->hasMany('App\Models\Deporte', 'Agrupacion_Id');
    }

    public function division(){   
        return $this->hasMany('App\Models\Division', 'Agrupacion_Id');  
    }
}

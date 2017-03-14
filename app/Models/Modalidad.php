<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = 'modalidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deporte_Id', 'Nombre_Modalidad'];

    public function deporte(){
        return $this->belongsTo('App\Models\Deporte', 'Deporte_Id');
    }

    public function division(){   
        return $this->hasMany('App\Models\Division', 'Modalidad_Id');  
    }

   public function modalidad_clasificacion_funcional() {
        return $this->hasMany('App\Models\Modalidad_Clasificacion_Funcional', 'Modalidad_Id');  
    }
}

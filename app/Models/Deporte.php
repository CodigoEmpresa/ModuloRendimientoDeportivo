<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    protected $table = 'deporte';
    protected $primaryKey = 'Id';
    protected $fillable = ['Agrupacion_Id', 'Nombre_Deporte'];

    public function agrupacion(){
        return $this->belongsTo('App\Models\Agrupacion', 'Agrupacion_Id');
    }

    public function modalidad(){
        return $this->hasMany('App\Models\Modalidad', 'Deporte_Id');
    }
}

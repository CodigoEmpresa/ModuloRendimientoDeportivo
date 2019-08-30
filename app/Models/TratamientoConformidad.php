<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TratamientoConformidad extends Model
{
    protected $table = 'tratamiento_conformidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tratamiento_Conformidad'];

    public function entrenamientoNoConformidad() {
        return $this->hasMany('App\Models\Entrenamiento', 'Tratamiento_Conformidad_Id');
    }
}

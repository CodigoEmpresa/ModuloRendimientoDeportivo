<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Horario'];

    public function entrenamiento(){
        return $this->hasMany('App\Models\Entrenamiento', 'Horario_Id');
    }
}

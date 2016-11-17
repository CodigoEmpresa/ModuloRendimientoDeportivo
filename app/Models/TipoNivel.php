<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoNivel extends Model
{
    protected $table = 'tipo_nivel';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_Nivel'];

    public function evento(){   
        return $this->hasMany('App\Models\Evento', 'Tipo_Nivel_Id');  
    }
}

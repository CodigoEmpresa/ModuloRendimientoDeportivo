<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Discapacidad'];

    public function deportistaParalimpico(){
        return $this->hasMany('App\Models\DeportistaParalimpico', 'Discapacidad_Id');
    }
}

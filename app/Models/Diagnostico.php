<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $table = 'diagnostico';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Diagnostico'];

    public function deportistaParalimpico(){
        return $this->hasMany('App\Models\DeportistaParalimpico', 'Diagnostico_Id');
    }
} 

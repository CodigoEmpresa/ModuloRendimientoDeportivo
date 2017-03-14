<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrenadorDeportista extends Model
{
    protected $table = 'entrenador_deportista';
    protected $primaryKey = 'Id';
    protected $fillable = ['Entrenador_Id', 'Deportista_Id'];

    public function entrenador(){
        return $this->belongsTo('App\Models\Entrenador', 'Entrenador_Id');
    }

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}
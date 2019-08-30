<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaApoyo extends Model
{
     protected $table = 'deportista_apoyo';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id','Apoyo_Id', 'Valor', 'Fecha'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}

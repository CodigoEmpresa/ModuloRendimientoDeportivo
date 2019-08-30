<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaAlimentacion extends Model
{
    protected $table = 'deportista_alimentacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id','Alimentacion_Id', 'Cantidad', 'Valor', 'Fecha'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}

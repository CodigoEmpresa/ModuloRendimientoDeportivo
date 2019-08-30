<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaDeporte extends Model
{
    protected $table = 'deportista_deporte';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id','Agrupacion_Id', 'Deporte_Id', 'Modalidad_Id'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function agrupacion(){
        return $this->belongsTo('App\Models\Agrupacion', 'Agrupacion_Id');
    }

    public function deporte(){
        return $this->belongsTo('App\Models\Deporte', 'Deporte_Id');
    }

    public function modalidad(){
        return $this->belongsTo('App\Models\Modalidad', 'Modalidad_Id');
    }

}

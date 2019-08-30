<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaEtapa extends Model
{
    protected $table = 'deportista_etapa';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id','Etapa_Id', 'Smmlv'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }	

    public function etapa(){
        return $this->belongsTo('App\Models\Etapa', 'Etapa_Id');
    }	
}
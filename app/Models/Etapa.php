<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $table = 'etapa';
    protected $primaryKey = 'Id';
    protected $fillable = ['Tipo_Etapa_Id', 'Nombre_Etapa', 'Estimulo'];
    
    public function tipoEtapa(){
        return $this->belongsTo('App\Models\TipoEtapa', 'Tipo_Etapa_Id');
    }

 	public function etapas()
    {
         //return $this->belongsTo('App\Models\Etapa', 'FK_I_ID_TIPO_DEPORTISTA');
    }

    /*public function deportistaEtapa(){
        return $this->hasMany('App\Models\DeportistaEtapa', 'Etapa_Id');
    }*/
}
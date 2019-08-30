<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEtapa extends Model
{
    protected $table = 'tipo_etapa';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_ETapa', 'Clasificacion_Deportista_Id'];
    
     public function tipoDeportista()
    {
        return $this->hasMany('App\Models\TipoEtapa', 'Clasificacion_Deportista_Id');
    }

    public function clasificacionDeportista(){
        return $this->belongsTo('App\Models\ClasificacionDeportista', 'Clasificacion_Deportista_Id');
    }

    public function etapa()
    {
        return $this->hasMany('App\Models\Etapa', 'Tipo_Etapa_Id');
    }
}

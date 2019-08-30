<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlimentacion extends Model
{
    protected $table = 'tipo_alimentacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_Alimentacion'];

    public function alimentacion()
    {
        return $this->hasMany('App\Models\Alimentacion', 'Tipo_Alimentacion_Id');
    }
}

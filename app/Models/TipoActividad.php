<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = 'tipo_actividad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_TipoActividad'];
}

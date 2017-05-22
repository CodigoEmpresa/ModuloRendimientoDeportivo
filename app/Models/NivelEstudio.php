<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelEstudio extends Model
{
    protected $table = 'nivel_estudio';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nivel_Estudio'];
}

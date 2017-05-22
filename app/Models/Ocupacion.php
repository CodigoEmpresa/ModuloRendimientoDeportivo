<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'ocupacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Ocupacion'];
}

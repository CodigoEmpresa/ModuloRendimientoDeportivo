<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodologoAgrupacion extends Model
{
    protected $table = 'metodologo_agrupacion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Persona_Id',  'Agrupacion_Id'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoDeporte extends Model
{
    protected $table = 'evento_deporte';
    protected $primaryKey = 'Id';
    protected $fillable = ['Evento_Id', 'Deporte_Id'];
}
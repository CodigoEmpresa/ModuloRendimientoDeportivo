<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoSilla extends Model
{
    protected $table = 'uso_silla';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Uso_Silla'];
} 

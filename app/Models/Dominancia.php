<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dominancia extends Model
{
    protected $table = 'dominancia';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Dominancia'];
}

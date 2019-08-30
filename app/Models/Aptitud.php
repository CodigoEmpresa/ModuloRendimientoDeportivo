<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aptitud extends Model
{
    protected $table = 'aptitud';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Aptitud'];
}

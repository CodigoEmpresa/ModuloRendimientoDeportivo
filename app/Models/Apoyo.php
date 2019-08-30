<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apoyo extends Model
{
    protected $table = 'apoyo';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Apoyo'];

     public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}

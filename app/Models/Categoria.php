<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categoria';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Categoria'];

    public function division(){   
        return $this->hasMany('App\Models\Division', 'Categoria_Id');  
    }
}

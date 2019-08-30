<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTest extends Model
{
    protected $table = 'tipo_test';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_Test'];

    public function Test(){
        return $this->hasMany('App\Models\Test', 'Tipo_Test_Id');
    }

    public function deportistaTest(){
        return $this->hasMany('App\Models\DeportistaTest', 'Tipo_Test_Id');
    }
}

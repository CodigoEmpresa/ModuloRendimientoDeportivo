<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariableTest extends Model
{
    protected $table = 'variable_test';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Variable', 'Unidad_Medicion'];

    public function deportistaTest(){
        return $this->hasMany('App\Models\DeportistaTest', 'Variable_Test_Id');
    }
}

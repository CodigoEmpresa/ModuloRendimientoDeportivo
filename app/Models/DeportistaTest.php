<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaTest extends Model
{
    protected $table = 'deportista_test';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id', /*'Tipo_Test_Id',*/ 'Test_Id', 'Variable_Test_Id', /*'Nombre_Test',*/ 'Resultado', 'Descripcion_Resultado'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    /*public function tipoTest(){
        return $this->belongsTo('App\Models\TipoTest', 'Tipo_Test_Id');
    }*/

    public function test(){
        return $this->belongsTo('App\Models\Test', 'Test_Id');
    }

    public function variableTest(){
        return $this->belongsTo('App\Models\VariableTest', 'Variable_Test_Id');
    }
}

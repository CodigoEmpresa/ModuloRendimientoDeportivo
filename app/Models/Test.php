<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $table = 'test';
    protected $primaryKey = 'Id';
    protected $fillable = ['Tipo_Test_Id', 'Nombre_Test'];

    public function tipoTest(){
        return $this->belongsTo('App\Models\TipoTest', 'Tipo_Test_Id');
    }

    public function deportistaTest(){
        return $this->hasMany('App\Models\DeportistaTest', 'Test_Id');
    }
}

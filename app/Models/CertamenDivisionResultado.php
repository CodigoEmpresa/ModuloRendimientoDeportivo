<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertamenDivisionResultado extends Model
{
    protected $table = 'certamen_division_resultado';
    protected $primaryKey = 'Id';
    protected $fillable = ['CertamenDivision_Id', 'Departamento_Id', 'Deportista_Id', 'Marca', 'Puesto'];

    public function resultadoExterno(){
        return $this->hasMany('App\Models\ResultadoExterno', 'CertamenDivisionResultado_Id');
    }

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function departamento(){
        return $this->belongsTo('App\Models\Departamento', 'Departamento_Id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComplemento extends Model
{
    protected $table = 'tipo_complemento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Tipo_Complemento'];

    public function complemento()
    {
        return $this->hasMany('App\Models\Complemento', 'Tipo_Complemento_Id');
    }
}
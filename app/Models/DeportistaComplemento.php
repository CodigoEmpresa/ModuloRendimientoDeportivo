<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeportistaComplemento extends Model
{
    protected $table = 'deportista_complemento';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deportista_Id','Complemento_Id', 'Cantidad', 'Valor', 'Fecha'];

    public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }
}
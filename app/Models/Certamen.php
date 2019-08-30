<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certamen extends Model
{
    protected $table = 'certamen';
    protected $primaryKey = 'Id';
    protected $fillable = ['Evento_Id','Sede_Id', 'Fecha_Inicio', 'Fecha_Fin', 'Nombre_Certamen'];

    public function evento(){
        return $this->belongsTo('App\Models\Evento', 'Evento_Id');
    }

    public function division()
    {
        return $this->belongsToMany('App\Models\Division','certamen_division','Certamen_Id','Division_Id');
    }
}
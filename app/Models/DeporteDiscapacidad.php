<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeporteDiscapacidad extends Model
{
    protected $table = 'deporte_discapacidad';
    protected $primaryKey = 'Id';
    protected $fillable = ['Deporte_Id', 'Discapacidad_Id'];
/*
    public function deportistaParalimpico(){
        return $this->hasMany('App\Models\DeportistaParalimpico', 'Discapacidad_Id');
    }
    $table->integer('Discapacidad_Id')->unsigned();
            $table->integer('Deporte_Id')->unsigned();
            $table->timestamps();

            $table->foreign('Discapacidad_Id')->references('Id')->on('discapacidad');
            $table->foreign('Deporte_Id')->references('Id')->on('deporte');
    */
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaAVisita extends Model
{
    protected $table = 'visita_pregunta_a';
    protected $primaryKey = 'Id';
    protected $fillable = ['Visita_Id', 'PreguntaA_Id', 'Respuesta_Id', 'Respuesta'];

    public function valoracionPsicoA(){
        return $this->belongsTo('App\Models\VisitaDomiciliaria', 'Visita_Id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValoracionRiesgo extends Model
{
   protected $table = 'valoracion_riesgo';
    protected $primaryKey = 'Id';    
    protected $fillable = ['Valoracion_Id', 'Factor', 'Objetivo', 'Intervencion', 'Fecha_Inicio', 'Fecha_Fin', 'Responsable', 'Autorizado', 'Seguimiento', 'Observacion', 'Anexo1', 'Anexo2', 'Anexo3', 'Anexo4'];

	public function valoracionPsico(){
        return $this->belongsTo('App\Models\ValoracionPsico', 'Valoracion_Id');
    }
}

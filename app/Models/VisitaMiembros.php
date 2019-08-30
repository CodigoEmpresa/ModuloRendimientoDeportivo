<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitaMiembros extends Model
{
    protected $table = 'visita_miembro';
    protected $primaryKey = 'Id';    
    protected $fillable = ['VisitaM_Id', 'Nombre_Miembro', 'Parentesco_Miembro', 'Regimen_Subsidiado', 'Regimen_Contributivo', 'Numero_Afiliados', 'Enfermedades', 'Discapacidades'];

	public function visitaDomiciliaria(){
        return $this->belongsTo('App\Models\VisitaDomiciliaria', 'VisitaM_Id');
    }
}

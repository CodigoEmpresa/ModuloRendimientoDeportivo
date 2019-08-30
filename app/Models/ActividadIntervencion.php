<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadIntervencion extends Model
{
    protected $table = 'actividad_intervencion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Tipo_Actividad_Id', 'Otro_Actividad', 'Descripcion', 'DeportistaP', 'DeportistaA', 'MultidisciplinarioP', 'MultidisciplinarioA', 'EntrenadorP', 
                           'EntrenadorA', 'ComisionadoP', 'ComisionadoA', 'Otros', 'OtrosP', 'OtrosA', 'Fecha_Programada', 'Fecha_Realizacion', 'Reprogramacion', 
                           'Total_Asistentes', 'Observaciones', 'Total_Evaluadores', 'Nombre_Gestor', 'Nombre_Coordinador', 'Anexo1_Url', 'Anexo2_Url', 'Anexo3_Url',
                           'Anexo4_Url']; 
    
    public function tipoActividad(){
        return $this->belongsTo('App\Models\TipoActividad', 'Tipo_Actividad_Id');
    }
}
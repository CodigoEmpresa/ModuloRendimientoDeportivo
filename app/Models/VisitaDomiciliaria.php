<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitaDomiciliaria extends Model
{
    protected $table = 'visita_domiciliaria';
    protected $primaryKey = 'Id';    
    protected $fillable = ['Deportista_Id, Fecha_Intervencion', 'Nombres_Receptor', 'Apellidos_Receptor', 'Documento_Receptor', 'Vivienda', 'Tipo_Vivienda', 
                           'Tipo_Vivienda_Propia', 'Area_Vivienda', 'Tiempo_Vivienda', 'Total_Habitaciones', 'Total_Banos', 'Total_Cocinas', 'Total_Salas', 
                           'Total_Comedores', 'Total_Ropas', 'Otros_Distribucion', 'Total_Camas', 'Total_Closets','Total_Televisores', 'Total_Neveras', 'Total_Estufas',
                           'Otros_Muebles', 'Aseo', 'Organizacion', 'Iluminacion', 'Ventilacion', 'Condiciones_Vivienda', 'Tipo_Ingreso', 'Total_Ingreso', 
                           'Egreso_Alimentacion', 'Egreso_Arriendo', 'Egreso_Educacion', 'Egreso_Cuota_Vivienda', 'Egreso_Salud', 'Egreso_Recreacion',
                           'Egreso_Servicios', 'Egreso_Transporte', 'Deudas', 'Deudas_Quien', 'Total_Egresos', 'Total_Deudas', 'Situacion_Economica', 
    					             'Practicas_Deportivas', 'Juegos_Familiares', 'Salidas_Publicas', 'Quehaceres', 'Actividad_Libre', 'Actividad_Academica', 
                           'Television', 'Internet', 'P16', 'P17', 'P18', 'P19', 'P20', 'P21','Concepto_Profesional', 'Genograma_Url', 'Genograma_Observacion', 
                           'Imagen1_Url', 'Imagen2_Url', 'Imagen3_Url', 'Imagen4_Url', 'Imagen5_Url', 'Imagen6_Url'];

	public function deportista(){
        return $this->belongsTo('App\Models\Deportista', 'Deportista_Id');
    }

    public function miembros(){
        return $this->hasMany('App\Models\VisitaMiembros', 'VisitaM_Id');
    }

    public function preguntaA(){
        return $this->hasMany('App\Models\PreguntaAVisita', 'Visita_Id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaInicialExamenFisico extends Model
{
    protected $table = 'historia_inicial_examen_fisico';
    protected $primaryKey = 'Id';
    protected $fillable = ['Historia_Inicial_Id', 'Pa_Pie_Dato', 'Pa_Pie_Observacion', 'Pa_Supino_Dato', 'Pa_Supino_Observacion', 'Fc_Reposo_Dato', 'Fc_Reposo_Observacion', 'Fr_Dato', 'Fr_Observacion', 'Temperatura_Dato', 'Temperatura_Observacion', 'Peso_Dato', 'Peso_Observacion', 'Estatura_Dato', 'Estatura_Observacion', 'Cabeza_Dato', 'Cabeza_Observacion', 'Cuello_Dato', 'Cuello_Observacion', 'Agudeza_Visual_Dato', 'Agudeza_Visual_Observacion', 'Od', 'Oi', 'F_De_O', 'Audicion_Dato', 'Audicion_Observacion', 'Orl_Dato', 'Orl_Observacion', 'Cavidad_Oral_Dato', 'Cavidad_Oral_Observacion', 'Pulmonar_Dato', 'Pulmonar_Observacion', 'Cardiaco_Dato', 'Cardiaco_Observacion', 'Vascular_Periferico_Dato', 'Vascular_Periferico_Observacion', 'Abdomen_Dato', 'Abdomen_Observacion', 'Genitourinario_Dato', 'Genitourinario_Observacion', 'Neurologico_Dato', 'Neurologico_Observacion', 'Piel_Faneras_Dato', 'Piel_Faneras_Observacion', 'Postura_Ap_Dato', 'Postura_Ap_Observacion', 'Postura_Pa_Dato', 'Postura_Pa_Observacion', 'Postura_Lateral_Dato', 'Postura_Lateral_Observacion', 'Postura_Cuello_Dato', 'Postura_Cuello_Observacion', 'Ms_Hombro_Dato', 'Ms_Hombro_Observacion', 'Ms_Codo_Dato', 'Ms_Codo_Observacion', 'Ms_Muneca_Dato', 'Ms_Muneca_Observacion', 'Ms_Mano_Dato', 'Ms_Mano_Observacion', 'Columna_Cervical_Dato', 'Columna_Cervical_Observacion', 'Columna_Dorsal_Dato', 'Columna_Dorsal_Observacion', 'Columna_Lumbosaca_Dato', 'Columna_Lumbosaca_Observacion', 'Mi_Cadera_Dato', 'Mi_Cadera_Observacion', 'Mi_Rodilla_Dato', 'Mi_Rodilla_Observacion', 'Mi_Tobillo_Dato', 'Mi_Tobillo_Observacion'];

    public function historiaInicial(){
        return $this->belongsTo('App\Models\HistoriaInicial', 'Historia_Inicial_Id');
    }
}

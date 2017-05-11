<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deportista extends Model
{
    protected $table = 'deportista';
    protected $primaryKey = 'Id';
    protected $fillable = [ 'Persona_Id', 'Clasificacion_Deportista_Id', 'Lugar_Expedicion_Id', 'Parentesco_Id', 'Departamento_Id_Localiza', 'Ciudad_Id_Localiza', 'Localidad_Id_Localiza', 'Estado_Civil_Id', 'Estrato_Id', 'Regimen_Salud_Id', 'Tipo_Afiliacion_Id', 'Nivel_Regimen_Sub_Id', 'Sudadera_Talla_Id', 'Camiseta_Talla_Id', 'Pantaloneta_Talla_Id', 'Tenis_Talla_Id', 'Grupo_Sanguineo_Id', 'Rh_Id', 'Tipo_Cuenta_Id', 'Banco_Id',
        'Arl_Id', 'Fondo_Pension_Id','Fecha_Expedicion', 'Numero_Pasaporte', 'Fecha_Pasaporte', 'Numero_Libreta_Mil', 'Distrito_Libreta_mil', 'Nombre_Contacto', 'Fijo_Contacto', 'Celular_Contacto', 'Barrio_Localiza', 'Direccion_Localiza', 'Fijo_Localiza', 'Celular_Localiza', 'Correo_Electronico', 'Numero_Hijos', 'Numero_Cuenta', 'Fecha_Afiliacion', 'Medicina_Prepago', 'Nombre_MedicinaPrepago', 'Riesgo_Laboral',    	 'Nombre_Fondo_Pension', 'Uso_Medicamento', 'Medicamento', 'Otro_Medico_Preg', 'Otro_Medico', 'Resolucion_Vigente', 'Deber_Obligacion', 'Imagen_Url', 'Archivo1_Url', 'Libreta_Preg', 'Eps_Id'
    ];

    public function Persona()
    {
        return $this->belongsTo('App\Models\Persona', 'Persona_Id');
    }

    public function ClasificacionDeportista()
    {
        return $this->belongsTo('App\Models\ClasificacionDeportista', 'Clasificacion_Deportista_Id');
    }

    public function Eps()
    {
        return $this->belongsTo('App\Models\Eps', 'Eps_Id');
    }

    public function deportistaDeporte(){
        return $this->hasMany('App\Models\DeportistaDeporte', 'Deportista_Id');
    }

    public function deportistaValoracion(){
        return $this->hasMany('App\Models\ValoracionPsico', 'Deportista_Id');
    }

    public function deportistaEtapa() {
        return $this->belongsToMany('App\Models\Etapa', 'deportista_etapa', 'Deportista_Id', 'Etapa_Id')->withTimestamps()->withPivot('Smmlv');
    }

    public function deportistaVisita(){
        return $this->hasMany('App\Models\VisitaDomiciliaria', 'Deportista_Id');
    }

    public function deportistaComplemento() {
        return $this->belongsToMany('App\Models\Complemento', 'deportista_complemento', 'Deportista_Id', 'Complemento_Id')
                ->withTimestamps()->withPivot('Cantidad')->withPivot('Fecha')->withPivot('Valor');
    }

    public function deportistaApoyo() {
        return $this->belongsToMany('App\Models\Apoyo', 'deportista_apoyo', 'Deportista_Id', 'Apoyo_Id')
                ->withTimestamps()->withPivot('Valor')->withPivot('Fecha');
    }

    public function deportistaAlimentacion() {
        return $this->belongsToMany('App\Models\Alimentacion', 'deportista_alimentacion', 'Deportista_Id', 'Alimentacion_Id')
                ->withTimestamps()->withPivot('Cantidad')->withPivot('Valor')->withPivot('Fecha');
    }

    public function deporte()
    {
        return $this->belongsToMany('App\Models\Deporte','deportista_deporte','Deportista_Id','Deporte_Id');
    }

    public function certamenDivision()
    {
        return $this->belongsToMany('App\Models\CertamenDivision','certamen_division_deportista','Deportista_Id','CertamenDivision_Id');
    }

    public function deportistaParalimpico(){
        return $this->hasMany('App\Models\DeportistaParalimpico', 'Deportista_Id');
    }

    public function deportistaEntrenador() {
        return $this->belongsToMany('App\Models\Entrenador', 'entrenador_deportista', 'Deportista_Id', 'Entrenador_Id');
    }


    public function planEntrenamiento() {
        return $this->hasMany('App\Models\PlanEntrenamiento', 'Deportista_Id');
    }

    public function deportistaEntrenamiento() {
        return $this->belongsToMany('App\Models\Entrenamiento', 'deportista_entrenamiento', 'Deportista_Id', 'Entrenamiento_Id');
    }

    public function deportistaTest(){
        return $this->hasMany('App\Models\DeportistaTest', 'Deportista_Id');
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    protected $table = 'entrenador';
    protected $primaryKey = 'Id';
    protected $fillable = [
            'Persona_Id',
            'Clasificacion_Deportista_Id',            
            'Agrupacion_Id',            
            'Deporte_Id',            
            'Modalidad_Id',            
            'Lugar_Expedicion_Id',
            'Fecha_Expedicion',
            'Numero_Pasaporte',
            'Fecha_Pasaporte',
            'Departamento_Id_Nac',  
            'Libreta_Preg',
            'Numero_Libreta_Mil',
            'Distrito_Libreta_Mil',          
            'Parentesco_Id',
            'Nombre_Contacto',            
            'Fijo_Contacto',
            'Celular_Contacto',     
            'Departamento_Id_Localiza',
            'Ciudad_Id_Localiza',
            'Direccion_Localiza',
            'Barrio_Localiza',
            'Localidad_Id_Localiza',         
            'Fijo_Localiza',
            'Celular_Localiza',
            'Correo_Electronico',    
            'Regimen_Salud_Id',
            'Fecha_Afiliacion',            
            'Tipo_Afiliacion_Id',
            'Medicina_Prepago',            
            'Nombre_MedicinaPrepago', 
            'Eps_Id',
            'Nivel_Regimen_Sub_Id',            
            'Riesgo_Laboral',                       
            'Arl_Id', 
            'Fondo_PensionPreg_Id', 
            'Fondo_Pension_Id',   
            'Profesional_Preg',
            'Titulo_Pregrado',                   
            'Titulo_Especializacion',
            'Titulo_Maestria',
            'Titulo_Doctorado',
            'Curso_Entrenadores',
            'Grupo_Sanguineo_Id',
            'Uso_Medicamento',
            'Medicamento',
            'Tiempo_Medicamento',
            'Otro_Medico_Preg',
            'Otro_Medico',
            'Sudadera_Talla_Id',
            'Camiseta_Talla_Id',
            'Pantaloneta_Talla_Id',
            'Tenis_Talla_Id',               

            'Imagen_Url',
            'Archivo1_Url' 
    ];

    public function Persona(){
        return $this->belongsTo('App\Models\Persona', 'Persona_Id');
    }

    public function entrenadorDeportista() {
        return $this->belongsToMany('App\Models\Deportista', 'entrenador_deportista', 'Entrenador_Id', 'Deportista_Id');
                //->withTimestamps()->withPivot('Cantidad')->withPivot('Fecha')->withPivot('Valor');
    }

    public function entrenamiento() {
        return $this->hasMany('App\Models\Entrenamiento', 'Entrenamiento_Id');
    }

    public function deporte(){
        return $this->belongsTo('App\Models\Deporte', 'Deporte_Id');
    }

    public function clasificacionDeportiva(){
        return $this->belongsTo('App\Models\ClasificacionDeportista', 'Clasificacion_Deportista_Id');
    }

    public function modalidad(){
        return $this->belongsTo('App\Models\Modalidad', 'Modalidad_Id');
    }

    public function ciudadLugar(){
        return $this->belongsTo('App\Models\Ciudad', 'Lugar_Expedicion_Id');
    }

    public function Eps()
    {
        return $this->belongsTo('App\Models\Eps', 'Eps_Id');
    }

    public function parentesco()
    {
        return $this->belongsTo('App\Models\Parentesco', 'Parentesco_Id');
    }

    public function departamentoLoc(){
        return $this->belongsTo('App\Models\Departamento', 'Departamento_Id_Localiza');
    }

    public function ciudadLoc(){
        return $this->belongsTo('App\Models\Ciudad', 'Ciudad_Id_Localiza');
    }

    public function localidadLoc(){
        return $this->belongsTo('App\Models\Localidad', 'Localidad_Id_Localiza');
    }

    public function regimen(){
        return $this->belongsTo('App\Models\RegimenSalud', 'Regimen_Salud_Id');
    }

    public function tipoAfiliacion(){
        return $this->belongsTo('App\Models\TipoAfiliacion', 'Tipo_Afiliacion_Id');
    }

    public function nivelRegimenSub(){
        return $this->belongsTo('App\Models\NivelRegimenSub', 'Nivel_Regimen_Sub_Id');
    }

    public function fondoPension(){
        return $this->belongsTo('App\Models\FondoPension', 'Fondo_Pension_Id');
    }

    public function grupoSanguineo(){
        return $this->belongsTo('App\Models\GrupoSanguineo', 'Grupo_Sanguineo_Id');
    }

    public function arl(){
        return $this->belongsTo('App\Models\Arl', 'Arl_Id');
    }

    

}
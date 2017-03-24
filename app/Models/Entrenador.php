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

    public function Persona()
    {
        return $this->belongsTo('App\Models\Persona', 'Persona_Id');
    }

     public function entrenadorDeportista() {
        return $this->belongsToMany('App\Models\Deportista', 'entrenador_deportista', 'Entrenador_Id', 'Deportista_Id');
                //->withTimestamps()->withPivot('Cantidad')->withPivot('Fecha')->withPivot('Valor');
    }

}
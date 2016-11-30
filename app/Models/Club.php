<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    /*protected $table = 'club';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Club'];*/

    protected $table = 'TB_SRD_CLUB_DEPORTIVO';
    protected $primaryKey = 'PK_I_ID_CLUB';
    protected $fillable = ['I_TIPO_CLUB', 'V_NOMBRE_CLUB', 'V_ACTO_RD', 'V_NUM_RESOLUCION_RD', 'D_FECHA_INI_RD',
    					 	'D_FECHA_TER_RD', 'V_NUM_RESOL_ACTU', 'D_FECHA_ACTO', 'V_NOM_PRESIDENTE', 'D_FECHA_INI_VIGENCIA',
    					 	'D_FECHA_TER_VIGENCIA', 'V_FECHA_ASAMBLEA', 'V_DIRECCION_ADMIN', 'V_TELEFONO_ADMIN',
    					 	'V_CORREO_ADMIN', 'FK_I_ID_LOCALIDAD_ADMIN', 'Id_Upz', 'Id_Barrio', 'V_DIRECCION_DEPORTIVA',
    					 	'V_TELEFONO_DEPORTIVA', 'V_SIPEJ', 'V_NUM_PERSONERIA', 'D_FECHA_PERSONERIA', 'V_NUM_EXPVIRTUAL',
    					 	'Fecha_Registro', 'Fecha_Cierre', 'Estado_Club', 'Motivo_Act'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = 'db_clubes';
    }
}

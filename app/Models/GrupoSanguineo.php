<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GrupoSanguineo extends Model
{
     protected $table = 'grupo_sanguineo';
    protected $primaryKey = 'Id_GrupoSanguineo';
    protected $fillable = ['Nombre_GrupoSanguineo'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = 'db_principal';
    }
}

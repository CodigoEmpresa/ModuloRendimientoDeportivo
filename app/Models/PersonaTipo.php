<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaTipo extends Model
{
     protected $table = 'persona_tipo';
    //protected $primaryKey = 'Id_Departamento';
    protected $fillable = ['Id_Tipo', 'Id_Persona'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = 'db_principal';
    }
}

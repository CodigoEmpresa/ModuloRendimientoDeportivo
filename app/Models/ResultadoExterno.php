<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoExterno extends Model
{
    protected $table = 'resultado_externo';
    protected $primaryKey = 'Id';
    protected $fillable = ['CertamenDivisionResultado_Id', 'Nombres'];

    public function certamenDivisionResultado(){
        return $this->belongsTo('App\Models\CertamenDivisionResultado', 'CertamenDivisionResultado_Id');
    }
}
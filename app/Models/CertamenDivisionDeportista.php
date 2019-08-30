<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertamenDivisionDeportista extends Model
{
    protected $table = 'certamen_division_deportista';
    protected $primaryKey = 'Id';
    protected $fillable = ['CertamenDivision_Id', 'Deportista_Id'];

    public function certamenDivision()
    {
        return $this->belongsToMany('App\Models\CertamenDivision','certamen_division_deportista','CertamenDivision_Id','Deportista_Id');
    }
}

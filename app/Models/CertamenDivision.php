<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertamenDivision extends Model
{
    protected $table = 'certamen_division';
    protected $primaryKey = 'Id';
    protected $fillable = ['Certamen_Id', 'Division_Id'];

    public function deportista()
    {
        return $this->belongsToMany('App\Models\Deportista','certamen_division_deportista','CertamenDivision_Id','Deportista_Id');
    }

    public function certamen()
    {
        return $this->belongsTo('App\Models\Certamen', 'Certamen_Id');
    } 

    public function division()
    {
        return $this->belongsTo('App\Models\Division', 'Division_Id');
    } 
}

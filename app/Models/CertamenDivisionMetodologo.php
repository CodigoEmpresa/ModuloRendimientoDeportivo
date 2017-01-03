<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertamenDivisionMetodologo extends Model
{
	protected $table = 'certamen_division_metodologo';
    protected $primaryKey = 'Id';
    protected $fillable = ['CertamenDivision_Id', 'Persona_Id'];

   public function cetamenDivision(){  
   	return $this->belongsTo('App\Models\CertamenDivision', 'CertamenDivision_Id'); 
   }

}

<?php
/**
 * Created by PhpStorm.
 * User: Jona
 * Date: 10/08/2017
 * Time: 10:38 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Deportista', 'Tipo', 'Fecha'];
    public $timestamps = false;

    public function deportista()
    {
        return $this->belongsTo('App\Models\Deportista', 'Id_Deportista');
    }
}
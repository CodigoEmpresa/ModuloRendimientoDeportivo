<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 11/08/17
 * Time: 11:10 AM
 */

namespace App\Http\Controllers;

use App\Models\Deportista;
use App\Models\Ingreso;
use App\Http\Requests\RegistroIngresos;

class IngresoController extends Controller
{
    public function index($id_deportista = 0)
    {
        $deportista = $id_deportista == 0 ? null : Deportista::with(['ingresos' => function($query){
            $query->orderBy('Fecha', 'asc');
        }, 'persona'])->find($id_deportista);

        $datos = [
            'deportista' => $deportista,
        ];

        return view('SIAB/ingresos', $datos);
    }

    public function guardar(RegistroIngresos $request)
    {
        $ingreso = new Ingreso;

        $ingreso['Tipo'] = $request->input('tipo');
        $ingreso['Fecha'] = $request->input('fecha');
        $ingreso['Id_Deportista'] = $request->input('id_deportista');
        $ingreso->save();

        return redirect('irrd/'.$request->input('id_deportista'));
    }

    public function borrar($id_ingreso)
    {
        $ingreso = Ingreso::find($id_ingreso);
        $id_deportista = $ingreso->Id_Deportista;
        $ingreso->delete();

        return redirect('irrd/'.$id_deportista);
    }
}
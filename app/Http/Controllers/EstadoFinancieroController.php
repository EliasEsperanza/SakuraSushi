<?php

namespace App\Http\Controllers;
use App\Models\CuentasContables; 
use App\Models\Transacciones; 

use Illuminate\Http\Request;

class EstadoFinancieroController extends Controller
{
    public function balanceComprobacion()
{
    $cuentas = CuentasContables::with('transacciones')->get();
    return view('estados_financieros.balance_comprobacion', compact('cuentas'));
}

public function balanceGeneral()
{
    $activos = CuentasContables::where('tipo', 'activo')->get();
    $pasivos = CuentasContables::where('tipo', 'pasivo')->get();
    $capital = CuentasContables::where('tipo', 'capital')->get();
    return view('estados_financieros.balance_general', compact('activos', 'pasivos', 'capital'));
}
public function estadoResultados()
{
    $ingresos = Transacciones::where('tipo_movimiento', 'ingreso')->sum('monto');
    $costos = Transacciones::where('tipo_movimiento', 'costo')->sum('monto');
    $gastos = Transacciones::where('tipo_movimiento', 'gasto')->sum('monto');
    $beneficio = $ingresos - ($costos + $gastos);
    return view('estados_financieros.estado_resultados', compact('ingresos', 'costos', 'gastos', 'beneficio'));
}



}

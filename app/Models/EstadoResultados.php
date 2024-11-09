<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class EstadoResultados extends Model
{
    use HasFactory;
    public static function obtenerResultados()
    {
        // Obtenemos las cuentas de Ingresos y Gastos
        $ingresos = CuentasContables::where('tipo', 'ingreso')->with('transacciones')->get();
        $gastos = CuentasContables::whereIn('tipo', ['costo', 'gasto'])->with('transacciones')->get();

        // Calculamos el total de ingresos
        $totalIngresos = $ingresos->sum(function ($cuenta) {
            return $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
        });

        // Calculamos el total de gastos y costos
        $totalGastos = $gastos->sum(function ($cuenta) {
            return $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
        });

        // Calculamos la utilidad o pérdida neta
        $utilidadNeta = $totalIngresos - $totalGastos;

        return [
            'ingresos' => $totalIngresos,
            'gastos' => $totalGastos,
            'utilidad_neta' => $utilidadNeta,
        ];
    }
}
